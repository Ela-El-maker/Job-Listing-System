<?php

namespace App\Services;

use App\Models\Order;
use App\Models\UserPlan;
use Auth;
use Session;

class OrderService
{
    public static function storeOrder(string $transactionId, string $paymentProvider, string $amount, string $paidInCurrency, string $paymentStatus)
    {
        $selectedPlan = Session::get('selected_plan');

        $order = new Order();
        $order->company_id = Auth::user()->company->id;
        $order->plan_id = $selectedPlan['id'];
        $order->package_name = $selectedPlan['label'];
        $order->transaction_id = $transactionId;
        $order->order_id = uniqid();
        $order->payment_provider = $paymentProvider;
        $order->amount = $amount;
        $order->paid_in_currency = $paidInCurrency;
        $order->default_amount = $selectedPlan['price'] . config('settings.site_default_currency');
        $order->payment_status = $paymentStatus;
        $order->save();
    }

    /**
     * Set or update the user's plan.
     *
     * @return void
     */
    public static function setUserPlan()
    {
        $selectedPlan = Session::get('selected_plan');
        $companyId = Auth::user()->company->id;

        $userPlan = UserPlan::where('company_id', $companyId)->first();

        UserPlan::updateOrCreate(
            ['company_id' => $companyId],
            [
                'plan_id' => $selectedPlan['id'],
                'job_limit' => $userPlan ? $userPlan->job_limit + $selectedPlan['job_limit'] : $selectedPlan['job_limit'],
                'featured_job_limit' => $userPlan ? $userPlan->featured_job_limit + $selectedPlan['featured_job_limit'] : $selectedPlan['featured_job_limit'],
                'highlight_job_limit' => $userPlan ? $userPlan->highlight_job_limit + $selectedPlan['highlight_job_limit'] : $selectedPlan['highlight_job_limit'],
                'profile_verified' => $selectedPlan['profile_verified'],
            ]
        );
    }

    /**
     * Check if the company has already used the free plan.
     *
     * @param int $companyId
     * @return bool
     */
    public static function hasUsedFreePlan($companyId)
    {
        return Order::where('company_id', $companyId)
            ->where('payment_provider', 'free') // Use 'payment_provider' instead of 'payment_method'
            ->exists();
    }
}
