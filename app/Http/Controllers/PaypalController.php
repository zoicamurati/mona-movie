<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;

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
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'order' => 'required',
            'city' => 'required',
        ]);

        $order = $this->createOrder($request->all());

        $cart = $this->getCheckoutData();


        try {
            $response = $this->provider->setExpressCheckout($cart);

            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $this->updateOrder('Invalid');

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


            $invoice = $this->updateOrder($status);

            if ($invoice->paid_status) {
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
        $order_id = Session::get('order_id');
        $order = Order::find($order_id);
        $data = [];
        $data['items'] = [];

        foreach (json_decode($order->order) as $item) {

            $temp =
                [
                    'name' => $item->items[0]->title,
                    'price' => $item->items[0]->price,
                    'qty' => count($item->items),
                ];

            array_push($data['items'], $temp);
        }


        $data['return_url'] = url('/paypal/success-transaction');


        $data['invoice_id'] = config('paypal.invoice_prefix') . '_' . $order_id;
        $data['invoice_description'] = "Order #$order_id Invoice";
        $data['cancel_url'] = url('/');
        $data['shipping'] = $order->shipping_cost;

        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['subtotal'] = $total;
        $data['total'] = $total + $order->shipping_cost;

        return $data;
    }

    /**
     * Create order.
     *
     * @param array $cart
     * @param string $status
     *
     * @return \App\Order
     */
    protected function createOrder($request)
    {
        $order = new Order();

        $order->name = $request['name'] . ' ' . $request['surname'];
        $order->address = $request['address'];
        $order->phone = $request['phone'];
        $order->email = $request['email'];
        $order->order = $request['order'];
        $order->city = $request['city'];
        $order->tracking_number = 'ORD-AA11' . rand(1, 100000);
        $order->shipping_cost = $request['shipping'];
        // $order->shipping_weight = $request['totalWeight'];


        $order->save();

        //update product quantity
        $this->updateQuantity($order->order);

        $exists = Client::where('phone', $order->phone)->first();
        if ($exists) {
            $exists->order = (int)$exists->order + 1;
            $exists->save();
        } else {
            $client = new Client();
            $client->name = $order->name;
            $client->address = $order->address;
            $client->phone = $order->phone;
            $client->city = $order->city;
            $client->email = $order->email;
            $client->order = 1;
            $client->save();
        }
        $users = User::where('type', 1)->get();
        foreach ($users as $user) {
            $user->notify(new NewOrder($order));
        }

        # We need to update the order if the payment is complete, so we save it to the session
        Session::put('order_id', $order->id);
        return $order;
    }

    /**
     * Update order status
     *
     * @param $status
     * @return mixed
     */
    public function updateOrder($status)
    {
        $order_id = Session::get('order_id');

        $order = Order::find($order_id);

        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
            $order->paid_status = 1;
        } else {
            $order->paid_status = 0;
        }
        $order->save();
        return $order;
    }

    /**
     * Update product quantity
     *
     * @param $order
     */
    public function updateQuantity($order)
    {

        foreach (json_decode($order, true) as $item) {

            $quantity = count($item['items']);
            $id = $item['id'];

            $post = Post::find($id);

            $post->quantity = $post->quantity - $quantity;
            $post->save();

        }
    }
}
