<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendJobPageController extends Controller
{
    //
    public function index(Request $request): View
    {
        // Fetch active jobs with a deadline in the future

        $countries = Country::all();
        $states = Country::where('id', 1)->exists() ? Country::find(1)->states : collect(); // Ensure ID 1 exists

        $jobCategories = JobCategory::withCount(['jobs' => function ($query) {
            $query->where('status', 'active')
                ->where('deadline', '>=', now());
        }])->get();
        // dd($jobCategories);
        $jobTypes = JobType::all();
        $selectedStates = null;
        $selectedCities = null;
        $query = Job::query();
        $query->where('status', 'active')
            ->where('deadline', '>=', now()); // Deadline is in the future

        // Apply search filter if provided
        if ($request->has('search') && $request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->has('country') && $request->filled('country')) {
            $query->where('country_id', $request->country);
            $selectedStates = State::where('country_id', $request->country)->get();
        }

        if ($request->has('state') && $request->filled('state')) {
            $query->where('state_id', $request->state);
            $selectedCities = City::where('state_id', $request->state)->get();
        }

        if ($request->has('city') && $request->filled('city')) {
            $query->where('city_id', $request->city);
        }
        // if ($request->has('category') && $request->filled('category')) {
        //     $categoryIds = JobCategory::whereIn('slug', $request->category)->pluck('id')->toArray();
        //     $query->whereIn('job_category_id', $categoryIds);
        // }

        // New category filter using whereHas (previously for industry)
        // if ($request->has('category') && $request->filled('category')) {
        //     $categorySlugs = is_array($request->category) ? $request->category : [$request->category];

        //     $query->whereHas('category', function ($query) use ($categorySlugs) {
        //         $query->whereIn('slug', $categorySlugs);
        //     });
        // }

        if ($request->has('category') && $request->filled('category')) {
            $categorySlugs = is_array($request->category) ? $request->category : [$request->category];

            $categoryIds = JobCategory::whereIn('slug', $categorySlugs)->pluck('id')->toArray();
            $query->whereIn('job_category_id', $categoryIds);

            $query->orWhereHas('category', function ($query) use ($categorySlugs) {
                $query->whereIn('slug', $categorySlugs);
            });
        }



        // Salary filter
        if ($request->has('min_salary') && $request->filled('min_salary') && $request->min_salary > 0) {
            $query->where(function ($q) use ($request) {
                $q->where('min_salary', '>=', $request->min_salary)
                    ->orWhere('max_salary', '>=', $request->min_salary);
            });
        }


        // if ($request->has('jobtype') && $request->filled('jobtype')) {
        //     $query->whereIn('job_type_id', JobType::whereIn('slug', $request->jobtype)->pluck('id'));
        // }

        if ($request->has('jobtype') && $request->filled('jobtype')) {
            $jobTypeSlugs = is_array($request->jobtype) ? $request->jobtype : [$request->jobtype];

            $jobTypeIds = JobType::whereIn('slug', $jobTypeSlugs)->pluck('id')->toArray();
            $query->whereIn('job_type_id', $jobTypeIds);

            $query->orWhereHas('jobType', function ($query) use ($jobTypeSlugs) {
                $query->whereIn('slug', $jobTypeSlugs);
            });
        }


        // Get top 3 job categories by job count
        $popularCategories = JobCategory::withCount(['jobs' => function ($query) {
            $query->where('status', 'active')
                ->where('deadline', '>=', now());
        }])
            ->orderBy('jobs_count', 'desc') // Sort by job count (most popular)
            ->limit(3) // Get only the top 3 categories
            ->get();

        // Get top 2 job types by job count
        $popularJobTypes = JobType::withCount('jobs')
            ->orderBy('jobs_count', 'desc') // Sort by job count
            ->limit(2) // Get only the top 2 job types
            ->get();


        // Eager load relationships
        $query->with(['country', 'state', 'city', 'category', 'jobType']);


        $jobs = $query->paginate(18);

        return view('frontend.pages.jobs-index', compact('jobs', 'countries', 'selectedStates', 'selectedCities', 'jobCategories', 'jobTypes', 'popularCategories', 'popularJobTypes'));
    }

    function show(string $slug): View
    {
        $job = Job::where('slug', $slug)->firstOrFail();
        $openJobs = Job::where('company_id', $job->company->id)
            ->where('deadline', '>=', date('Y-m-d'))
            ->where('status', 'active')
            ->count();
        // $similarJobs = Job::where('job_category_id', $job->job_category_id)->get();
        // dd($similarJobs->count());


        // dd($job->job_category_id);
        // dd($job->job_category_id);



        // Fetch similar jobs (same category and active with future deadlines)
        $similarJobs = Job::where('job_category_id', $job->job_category_id)
            ->where('id', '!=', $job->id)
            ->where('status', 'active') // Only fetch active jobs
            ->where('deadline', '>=', now()) // Ensure the deadline is in the future
            ->limit(5)
            ->get();


        // dd($similarJobs->toArray());


        return view('frontend.pages.jobs-show', compact('job', 'openJobs', 'similarJobs'));
    }
}
