<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// Import the class namespaces first, before using it directly
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    //
    /**
     * Paypal Payment
     *
     */
    function setPaypalConfig() : array
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
        $provider ->getAccessToken();

        // Calculate payable amount
        $payableAmount = round(Session::get('selected_plan')['price'] * config('gatewaySettings.paypal_currency_rate'));
        // dd($payableAmount);
        $response = $provider -> createOrder(
            [
                'intent' => 'CAPTURE',
                'application_context' => [
                    'return_url' => route('company.paypal.success'),
                    'cancel_url' => route('company.paypal.cancel'),
                ],
                'purchase_units' =>[
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
        if(isset($response['id']) && $response['id'] !== NULL)
        {
            foreach ($response['links'] as $link) {
                # code...
                if($link['rel'] === 'approve')
                {
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
        //handle payment redirect
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $response = $provider ->capturePaymentOrder($request->token);
        dd($response);

    }
    /**
     * Paypal Cancel
     *
     */
    function paypalCancel()
    {
        //handle payment redirect
    }
}
