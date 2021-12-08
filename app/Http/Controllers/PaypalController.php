<?php

namespace App\Http\Controllers;

use App\Client;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return view('transaction', compact('response'));
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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        $price=19;
        $order = $this->createInvoice($price,$user->id);

        Session::put('user_id', $user->id);
        Session::put('total', $price);

        $cart = $this->getCheckoutData();

        try {

            $response = $this->provider->setExpressCheckout($cart);

            return redirect($response['paypal_link']);
        } catch (\Exception $e) {

            $this->updateInvoice('Invalid');

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

        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            // Perform transaction on PayPal
            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];


            $invoice = $this->updateInvoice($status);

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
            'name' => 'Movie',
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
        $invoice->title = "Movie paymant";
        $invoice->total = $price;
        $invoice->status = 0;


        $invoice->save();


        # We need to update the order if the payment is complete, so we save it to the session
        Session::put('invoice_id', $invoice->id);

        return $invoice;
    }

    /**
     * Update invoice status
     *
     * @param $status
     * @return mixed
     */
    protected function updateInvoice($status)
    {
        $invoice_id = Session::get('invoice_id');

        $invoice = Invoice::find($invoice_id);

        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
            $invoice->status = 1;
        } else {
            $invoice->status = 0;
        }

        $invoice->save();

        return $invoice;
    }

}
