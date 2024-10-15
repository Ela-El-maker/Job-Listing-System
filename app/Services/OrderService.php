<?php

namespace App\Services;

use App\Models\Order;
use Auth;
use Session;

class OrderService
{
    static function storeOrder(string $transactionId, String $paymentProvider, String $amount, String $paidInCurrency, String $paymentStatus)
    {
        $order = new Order();
        $order->company_id = Auth::user()->company->id;
        $order->plan_id = Session::get('selected_plan')['id'];
        $order->package_name = Session::get('selected_plan')['label'];
        $order->transaction_id = $transactionId;
        $order->order_id = uniqid();
        $order->payment_provider = $paymentProvider;
        $order->amount = $amount;
        $order->paid_in_currency = $paidInCurrency;
        $order->default_amount = Session::get('selected_plan')['price'] . config('settings.site_default_currency');
        $order->payment_status = $paymentStatus;
        $order->save();
    }
}
