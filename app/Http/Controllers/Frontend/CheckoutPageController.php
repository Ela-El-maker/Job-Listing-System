<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CheckoutPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id) : View
    {
        //
        $plan = Plan::findorfail($id);
        Session::put('selected_plan',$plan->toArray());
        return view('frontend.pages.checkout-index',compact('plan'));
    }
}
