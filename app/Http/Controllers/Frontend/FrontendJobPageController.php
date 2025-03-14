<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendJobPageController extends Controller
{
    //
    public function index()
    {
        // Fetch active jobs with a deadline in the future
        $jobs = Job::where('status', 'active')
            ->where('deadline', '>=', date('Y-m-d')) // Deadline is in the future
            ->paginate(20);

        return view('frontend.pages.jobs-index', compact('jobs'));
    }

    function show(string $slug): View
    {
        $job = Job::where('slug', $slug)->firstOrFail();
        $openJobs = Job::where('company_id', $job->company->id)
            ->where('deadline', '>=', date('Y-m-d'))
            ->where('status', 'active')
            ->count();
        return view('frontend.pages.jobs-show', compact('job', 'openJobs'));
    }
}
