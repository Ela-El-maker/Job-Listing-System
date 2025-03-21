<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\IndustryType;
use App\Models\Job;
use App\Models\OrganizationType;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendCompanyPageController extends Controller
{
    //

    function index(Request $request): View
    {

        $countries = Country::all();
        $states = Country::where('id', 1)->exists() ? Country::find(1)->states : collect(); // Ensure ID 1 exists
        $industryTypes = IndustryType::withCount('companies')->get();
        $organisations = OrganizationType::withCount('companies')->get();
        $selectedStates = null;
        $selectedCities = null;



        $query = Company::query();
        $query->withCount(['jobs' => function ($query) {
            $query->where('status', 'active')->where('deadline', '>=', now());
        }])->where(['profile_completion' => 1, 'visibility' => 1]);

        // Apply search filter if provided
        if ($request->has('search') && $request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->has('country') && $request->filled('country')) {
            $query->where('country', $request->country);
            $selectedStates = State::where('country_id', $request->country)->get();
        }

        if ($request->has('state') && $request->filled('state')) {
            $query->where('state_id', $request->state);
            $selectedCities = City::where('state_id', $request->state)->get();
        }

        if ($request->has('city') && $request->fillezd('city')) {
            $query->where('city', $request->city);
        }

        if ($request->has('industry') && $request->filled('industry')) {
            $query->whereHas('industryType', function ($query) use ($request) {
                $query->where('slug', $request->industry);
            });
        }

        if ($request->has('organization') && $request->filled('organization')) {
            $query->whereHas('organizationType', function ($query) use ($request) {
                $query->where('slug', $request->organization);
            });
        }



        $companies = $query->paginate(21);


        // dd($companies);
        return view('frontend.pages.company-index', compact('companies', 'countries', 'selectedStates', 'selectedCities', 'industryTypes', 'organisations'));
    }

    function show(string $slug): View
    {
        $company = Company::where(['profile_completion' => 1, 'visibility' => 1, 'slug' => $slug])->firstOrFail();

        // $openJobs = Job::where('company_id', $company->id)
        //     ->where('deadline', '>=', date('Y-m-d'))
        //     ->where('status', 'active')
        //     ->count();
        $openJobs = Job::where('company_id', $company->id)
            ->where('deadline', '>=', date('Y-m-d'))
            ->where('status', 'active')
            ->paginate(5); // Use paginate() if needed


        return view('frontend.pages.company-details', compact('company', 'openJobs'));
    }
}
