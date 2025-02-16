<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;


class PaymentController extends Controller
{
    //
    function paymentSuccess(): View
    {
        return view('frontend.pages.payment-success');
    }

    function paymentError(): View
    {
        return view('frontend.pages.payment-error');
    }
    //
    /**
     * Paypal Payment
     *
     */
    function setPaypalConfig(): array
    {

        return  [
            'mode'    => config('gatewaySettings.paypal_account_mode'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => config('gatewaySettings.paypal_client_id'),
                'client_secret'     => config('gatewaySettings.paypal_client_secret'),
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => config('gatewaySettings.paypal_client_id'),
                'client_secret'     => config('gatewaySettings.paypal_client_secret'),
                'app_id'            => config('gatewaySettings.paypal_app_id'),
            ],

            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => config('gatewaySettings.paypal_currency_name'),
            'notify_url'     => '', // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
        ];
    }

    /**
     * Paypal Success
     *
     */
    function payWithPaypal()
    {
        //handle payment redirect
        // dd($this->setPaypalConfig());
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        // Calculate payable amount
        $payableAmount = round(Session::get('selected_plan')['price'] * config('gatewaySettings.paypal_currency_rate'));
        // dd($payableAmount);
        $response = $provider->createOrder(
            [
                'intent' => 'CAPTURE',
                'application_context' => [
                    'return_url' => route('company.paypal.success'),
                    'cancel_url' => route('company.paypal.cancel'),
                ],
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => config('gatewaySettings.paypal_currency_name'),
                            'value' => $payableAmount
                        ]
                    ]
                ]
            ],
        );

        // dd($response);
        if (isset($response['id']) && $response['id'] !== NULL) {
            foreach ($response['links'] as $link) {
                # code...
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }
    }

    /**
     * Paypal Success
     *
     */
    function paypalSuccess(Request $request)
    {
        //handle payment redirection
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        // dd($response);
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $capture = $response['purchase_units'][0]['payments']['captures'][0];
            try {
                //code...
                OrderService::storeOrder($capture['id'], 'payPal', $capture['amount']['value'], $capture['amount']['currency_code'], 'paid');
                OrderService::setUserPlan();

                Session::forget('selected_plan');

                return redirect()->route('company.payment.success');
            } catch (\Exception $th) {
                logger('Payment ERROR >> '.$th);
            }
        }

        // return redirect()->route('company.payment.error')->withErrors(['error'=>$response['error']['message']]);
        return redirect()->route('company.payment.error')
        ->withErrors(['error' => $response['error']['message'] ?? 'Payment failed. Please try again.']);

    }
    /**
     * Paypal Cancel
     *
     */
    function paypalCancel()
    {
        //handle payment redirect
        return redirect()->route('company.payment.error')->withErrors(['error'=>'Something went wrong. Please Try Again.']);

    }


    /**
     * Stripe Payment
     *
     */


    function payWithStripe()
    {

    }

    function stripeSuccess()
    {
        // Stripe::setApiKey();

    }
}
