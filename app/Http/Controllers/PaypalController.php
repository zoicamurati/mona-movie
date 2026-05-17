<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
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

    public function processTransaction(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Session::put('request_name', $request->name);
        Session::put('request_email', $request->email);
        Session::put('request_password', Hash::make($request->password));

        $price = config('app.price');
        Session::put('total', $price);

        $invoiceId = uniqid();
        Session::put('invoice_id', $invoiceId);

        try {
            $provider = $this->makeProvider();

            $order = $provider->createOrder([
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'reference_id' => config('paypal.invoice_prefix') . '_' . $invoiceId,
                    'description'  => 'Movie MEFAT',
                    'amount'       => [
                        'currency_code' => config('paypal.currency', 'EUR'),
                        'value'         => number_format($price, 2, '.', ''),
                    ],
                ]],
                'application_context' => [
                    'return_url'          => url('/paypal/success-transaction'),
                    'cancel_url'          => url('/'),
                    'shipping_preference' => 'NO_SHIPPING',
                ],
            ]);

            if (isset($order['id'])) {
                $approvalUrl = collect($order['links'])->firstWhere('rel', 'approve')['href'] ?? null;
                if ($approvalUrl) {
                    return redirect($approvalUrl);
                }
            }

            \Log::error('PayPal createOrder failed', ['response' => $order]);
            session()->put(['code' => 'danger', 'message' => 'Error initiating PayPal payment.']);
        } catch (\Exception $e) {
            \Log::error('PayPal processTransaction exception', ['error' => $e->getMessage()]);
            session()->put(['code' => 'danger', 'message' => 'Error processing PayPal payment.']);
        }

        return redirect()->route('register');
    }

    public function successTransaction(Request $request)
    {
        $token = $request->get('token'); // PayPal order ID

        try {
            $provider = $this->makeProvider();

            $response = $provider->capturePaymentOrder($token);
            \Log::info('PayPal capturePaymentOrder', ['response' => $response]);

            if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                $payer = $response['payer'] ?? [];
                $payerName  = trim(($payer['name']['given_name'] ?? '') . ' ' . ($payer['name']['surname'] ?? ''));
                $payerEmail = $payer['email_address'] ?? '';

                Session::put('user_name', $payerName);
                Session::put('user_email', $payerEmail);

                try {
                    $invoice = $this->saveUser('Completed', $token);
                } catch (\Exception $e) {
                    // Payment captured but user creation failed log with PayPal order ID for manual recovery
                    \Log::critical('PayPal payment captured but user creation failed', [
                        'paypal_order_id' => $token,
                        'payer_email'     => $payerEmail,
                        'error'           => $e->getMessage(),
                    ]);
                    session()->put(['code' => 'danger', 'message' => 'Payment received but account setup failed. Please contact support with your email address.']);
                    return redirect()->route('register');
                }

                if ($invoice->status) {
                    Session::forget(['request_name', 'request_email', 'request_password', 'user_name', 'user_email', 'total', 'invoice_id']);
                    return redirect()->route('accept_agreement');
                }

                session()->put(['code' => 'danger', 'message' => 'Payment received but order could not be confirmed.']);
            } else {
                \Log::warning('PayPal capture not completed', ['response' => $response]);
                session()->put(['code' => 'danger', 'message' => 'Payment was not completed.']);
            }
        } catch (\Exception $e) {
            \Log::error('PayPal successTransaction exception', ['error' => $e->getMessage()]);
            session()->put(['code' => 'danger', 'message' => 'Error confirming PayPal payment.']);
        }

        return redirect()->route('register');
    }

    public function processRebuy(Request $request)
    {
        $price = config('app.price');
        Session::put('total', $price);

        $invoiceId = uniqid();
        Session::put('invoice_id', $invoiceId);

        try {
            $provider = $this->makeProvider();

            $order = $provider->createOrder([
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'reference_id' => config('paypal.invoice_prefix') . '_' . $invoiceId,
                    'description'  => 'Movie MEFAT',
                    'amount'       => [
                        'currency_code' => config('paypal.currency', 'EUR'),
                        'value'         => number_format($price, 2, '.', ''),
                    ],
                ]],
                'application_context' => [
                    'return_url'          => url('/paypal/rebuy-success-transaction'),
                    'cancel_url'          => url('/access-expired'),
                    'shipping_preference' => 'NO_SHIPPING',
                ],
            ]);

            if (isset($order['id'])) {
                $approvalUrl = collect($order['links'])->firstWhere('rel', 'approve')['href'] ?? null;
                if ($approvalUrl) {
                    return redirect($approvalUrl);
                }
            }

            \Log::error('PayPal rebuy createOrder failed', ['response' => $order]);
        } catch (\Exception $e) {
            \Log::error('PayPal processRebuy exception', ['error' => $e->getMessage()]);
        }

        return redirect()->route('access.expired');
    }

    public function successRebuy(Request $request)
    {
        $token = $request->get('token');

        try {
            $provider = $this->makeProvider();
            $response = $provider->capturePaymentOrder($token);

            \Log::info('PayPal rebuy capturePaymentOrder', ['response' => $response]);

            if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                $invoice                  = new Invoice();
                $invoice->user_id         = Auth::id();
                $invoice->title           = 'Movie payment';
                $invoice->total           = Session::get('total');
                $invoice->status          = 1;
                $invoice->paypal_order_id = $token;
                $invoice->save();

                Session::forget(['total', 'invoice_id']);

                return redirect()->route('accept_agreement');
            }

            \Log::warning('PayPal rebuy capture not completed', ['response' => $response]);
        } catch (\Exception $e) {
            \Log::error('PayPal successRebuy exception', ['error' => $e->getMessage()]);
        }

        return redirect()->route('access.expired');
    }

    protected function makeProvider(): PayPalClient
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        return $provider;
    }

    protected function saveUser(string $status, string $paypalOrderId = ''): Invoice
    {
        $price          = Session::get('total');
        $payerName      = Session::get('user_name');
        $payerEmail     = Session::get('user_email');
        $requestName    = Session::get('request_name');
        $requestEmail   = Session::get('request_email');
        $hashedPassword = Session::get('request_password');

        $user = User::create([
            'name'       => $requestName,
            'email'      => $requestEmail,
            'password'   => $hashedPassword,
            'real_name'  => $payerName,
            'real_email' => $payerEmail,
        ]);

        event(new Registered($user));

        $invoice = new Invoice();
        $invoice->user_id         = $user->id;
        $invoice->title           = 'Movie payment';
        $invoice->total           = $price;
        $invoice->status          = strcasecmp($status, 'Completed') === 0 ? 1 : 0;
        $invoice->paypal_order_id = $paypalOrderId;
        $invoice->save();

        if ($invoice->status) {
            Auth::login($user);
        }

        return $invoice;
    }
}
