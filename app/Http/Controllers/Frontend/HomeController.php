<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ClientReview;
use App\Models\Company;
use App\Models\Counter;
use App\Models\Country;
use App\Models\Hero;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\LearnMore;
use App\Models\Plan;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    //return home view
    function index(): View
    {
        $hero = Hero::first(); // Get the first hero record, or null if none exists
        $jobCategories = JobCategory::all();
        $countries = Country::all();
        $plans = Plan::where(['frontend_show' => 1, 'show_at_home' => 1])->get();
        $jobCount = Job::count(); // Get the total count of jobs
        $popularJobCategories = JobCategory::withCount(['jobs' => function ($query) {
            $query->where(['status' => 'active'])->where('deadline', '>=', now());
        }])->where('show_at_popular', 1)->get();
        $featuredCategories = JobCategory::where('show_at_featured', 1)->take(6)->get();
        $whyChooseUs = WhyChooseUs::first();
        $learnMore = LearnMore::first();
        $counter = Counter::first();
        $companies = Company::with('companyCountry','jobs')->select('id','logo','name','slug','country','state')->withCount(['jobs'=>function($query){
            $query->where(['status'=> 'active'])->where('deadline','>=', now());
        }])->where(['profile_completion' => 1, 'visibility' => 1])->latest()->take(45)->get();
        $jobsByLocations = JobLocation::latest()->take(8)->get();
        $clientReviews = ClientReview::all();
        $blogs = Blog::latest()->take(6)->get();
        return view('frontend.home.index', compact('plans', 'hero', 'jobCategories', 'countries', 'jobCount', 'popularJobCategories', 'featuredCategories','whyChooseUs','learnMore','counter','companies','jobsByLocations','clientReviews','blogs'));
    }
}
