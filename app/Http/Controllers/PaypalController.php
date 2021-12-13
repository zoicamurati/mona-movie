<?php

namespace App\Http\Controllers;

use App\Client;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Validation\Rules;

class PaypalController extends Controller
{
    /**
     * @var ExpressCheckout
     */
    protected $provider;

    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }

    public function createTransaction(Request $request)
    {
        $response = [];
        if (session()->has('code')) {
            $response['code'] = session()->get('code');
            session()->forget('code');
        }

        if (session()->has('message')) {
            $response['message'] = session()->get('message');
            session()->forget('message');
        }

        $date = Carbon::now();
        // $date = Carbon::parse('2021-12-25 00:00:00');

        if ($date->betweenIncluded('2021-12-25 00:00:00', '2021-12-25 23:59:59')) {
            return view('watch_movie', compact('response'));
        } else {
            return view('transaction', compact('response'));
        }

    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function processTransaction(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);



        $price=Config::get('app.price');
       // $order = $this->createInvoice($price,$user->id);

        //Session::put('user_id', $user->id);
        Session::put('total', $price);

        $cart = $this->getCheckoutData();

        try {

            $response = $this->provider->setExpressCheckout($cart);
            \Log::info($response);
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            \Log::info($response);
            //$this->updateData('Invalid');

            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order!"]);
        }
    }

    /**
     * Process payment on PayPal.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function successTransaction(Request $request)
    {
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');

        $cart = $this->getCheckoutData();
        \Log::info('hyn');
        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);
        \Log::info($response);

        /* if (in_array(strtoupper($response['ACK']), ['SUCCESS','SUCCESSWITHWARNING'])) {*/

        if ((strtoupper($response['ACK']) === 'SUCCESS' || strtoupper($response['ACK']) === 'SUCCESSWITHWARNING' ) && $response['ACK'] !== 'Failure'){

            Session::put('user_name', $response['FIRSTNAME'].' '. $response['LASTNAME']);
            Session::put('user_email', $response['EMAIL']);
            // Perform transaction on PayPal

            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            \Log::info($payment_status);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            \Log::info($status);

            $invoice = $this->updateData($status);


            if ($invoice->status) {
                session()->put(['code' => 'success', 'message' => "Order has been paid successfully!"]);
            } else {
                session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order!"]);
            }

            return redirect('/paypal/create-transaction');
        }
    }


    /**
     * Set cart data for processing payment on PayPal.
     *
     * @param bool $recurring
     *
     * @return array
     */
    protected function getCheckoutData()
    {
        $invoice_id = Session::get('invoice_id');
        $price = Session::get('total');

        $data = [];
        $data['items'] = [[
            'name' => 'Movie Drilon Hoxha',
            'price' => $price,
            'qty' => 1,
        ]];


        $data['return_url'] = url('/paypal/success-transaction');


        $data['invoice_id'] = config('paypal.invoice_prefix') . '_' . $invoice_id;
        $data['invoice_description'] = "Order #$invoice_id Invoice";
        $data['cancel_url'] = url('/');


        $total = $price;

        $data['subtotal'] = $total;
        $data['total'] = $total;

        return $data;
    }

    /**
     * Create invoice
     *
     * @param $request
     * @return Invoice
     */
    protected function createInvoice($price,$user_id)
    {

        $invoice = new Invoice();

        $invoice->user_id = $user_id;
        $invoice->title = "Movie paymant shkembimi";
        $invoice->total = $price;
        $invoice->status = 0;


        $invoice->save();


        # We need to update the order if the payment is complete, so we save it to the session
        Session::put('invoice_id', $invoice->id);

        return $invoice;
    }

    /**
     * Update invoice status and user real name
     *
     * @param $status
     * @return mixed
     */
    protected function updateData($status)
    {
        $invoice_id = Session::get('invoice_id');


        $invoice = Invoice::find($invoice_id);

        $user_name = Session::get('user_name');
        $user_email = Session::get('user_email');

        $request_name = Session::get('request_name');
        $request_email = Session::get('request_email');
        $request_password = Session::get('request_password');


        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed') || !strcasecmp($status, 'Completed_Funds_Held') ) {
            $user = User::create([
                'name' => $request_name,
                'email' => $request_email,
                'password' => Hash::make($request_password),
                'real_name'=>$user_name,
                'real_email'=>$user_email,
            ]);

            event(new Registered($user));

            $invoice->status = 1;
            Auth::login($user);

        } else {
            $invoice->status = 0;
        }

        $invoice->save();

        return $invoice;
    }


}
