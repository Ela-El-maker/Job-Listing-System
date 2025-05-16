<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanCreateRequest;
use App\Models\Plan;
use App\Services\Notify;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PlanController extends Controller
{

     function __construct()
    {
        $this->middleware(['permission:price plan']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        //
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanCreateRequest $request) : RedirectResponse
    {
        //
        // dd($request->all());
        $plan = new Plan();
        $plan->label = $request->label;
        $plan->price = $request->price;
        $plan->job_limit = $request->job_limit;
        $plan->recommended = $request->recommended;
        $plan->featured_job_limit = $request->featured_job_limit;
        $plan->highlight_job_limit = $request->highlight_job_limit;
        $plan->profile_verified = $request->profile_verified;
        $plan->frontend_show = $request->frontend_show;
        $plan->save();
        Notify::createdNotification();

        return to_route('admin.plans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        //
        $plan = Plan::findorfail($id);
        return view('admin.plans.edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanCreateRequest $request, string $id) : RedirectResponse
    {
        //

        // dd($request->all());
        $plan = Plan::findorfail($id);
        $plan->label = $request->label;
        $plan->price = $request->price;
        $plan->job_limit = $request->job_limit;
        $plan->recommended = $request->recommended;
        $plan->featured_job_limit = $request->featured_job_limit;
        $plan->highlight_job_limit = $request->highlight_job_limit;
        $plan->profile_verified = $request->profile_verified;
        $plan->frontend_show = $request->frontend_show;
        $plan->show_at_home = $request->show_at_home;

        $plan->save();
        Notify::updatedNotification();

        return to_route('admin.plans.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        //
        // dd($id);
        try {
            Plan::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
