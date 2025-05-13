<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\JobBookmark;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CandidateDashboardController extends Controller
{
    //
    function index() : View
    {
        $jobApplied = AppliedJob::where('candidate_id',auth()->user()->id)->count();
        $userBookmarkedJobs = JobBookmark::where('candidate_id',auth()->user()?->candidateProfile?->id)->count();
        $appliedJobs = AppliedJob::with('job')->where('candidate_id', auth()->user()->id)->orderBy('id','desc')->paginate(5);
        return view('frontend.candidate-dashboard.dashboard',compact('jobApplied','userBookmarkedJobs','appliedJobs'));
    }
}
