<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\JobCreateRequest;
use App\Models\Benefits;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Education;
use App\Models\Job;
use App\Models\JobBenefits;
use App\Models\JobCategory;
use App\Models\JobExperience;
use App\Models\JobRole;
use App\Models\JobSkills;
use App\Models\JobTag;
use App\Models\JobType;
use App\Models\SalaryType;
use App\Models\Skill;
use App\Models\State;
use App\Models\Tag;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        storePlanInformation();
        $query = Job::query();

        $this->search($query, ['title', 'slug', 'deadline', 'status', 'created_at', 'updated_at']);

        $jobs = $query->where('company_id', auth()->user()->company?->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('frontend.company-dashboard.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View | RedirectResponse
    {
        //
        storePlanInformation();
        $userPlan = session('user_plan');
        // dd($userPlan);
        if ($userPlan->job_limit < 1) {
            Notify::errorNotification('You have reached your job plan limit. Please upgrade your plan to post more jobs.');

            return to_route('company.jobs.index')->with('error', 'Unable to retrieve your plan information. Please try again.');
        }
        $companies = Company::where(['profile_completion' => 1, 'visibility' => 1])->get();
        $categories = JobCategory::all();
        $countries = Country::all();
        $salaryTypes  = SalaryType::all();
        $experiences = JobExperience::all();
        $jobRoles = JobRole::all();
        $educations = Education::all();
        $jobTypes = JobType::all();
        $tags = Tag::all();
        $skills = Skill::all();
        return view('frontend.company-dashboard.job.create', compact('companies', 'categories', 'countries', 'salaryTypes', 'experiences', 'jobRoles', 'educations', 'jobTypes', 'tags', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCreateRequest $request)
    {
        //
        // dd($request->all());
        if (session('user_plan')->featured_job_limit < 1) {
            Notify::errorNotification('You have reached your Featured job plan limit. Please upgrade your plan to post more featured jobs.');
            return redirect()->back()->with('error', 'Unable to post job. Please try again.');
        }
        if (session('user_plan')->highlight_job_limit < 1) {
            Notify::errorNotification('You have reached your Highlighted job plan limit. Please upgrade your plan to post more highlighted jobs.');
            return redirect()->back()->with('error', 'Unable to post job. Please try again.');
        }

        $job = new Job();
        $job->title = $request->title;
        $job->company_id = auth()->user()->company->id;
        $job->job_category_id = $request->category;
        $job->vacancies = $request->vacancies;
        $job->deadline = $request->deadline;

        $job->country_id = $request->country;
        $job->state_id = $request->state;
        $job->city_id = $request->city;
        $job->address = $request->address;


        $job->salary_mode = $request->salary_mode;
        $job->min_salary = $request->min_salary;
        $job->max_salary = $request->max_salary;
        $job->custom_salary = $request->custom_salary;
        $job->salary_type_id = $request->salary_type;

        $job->job_experience_id = $request->experience;
        $job->job_role_id = $request->job_role;
        $job->education_id = $request->education;
        $job->job_type_id = $request->job_type;

        //Tags, Benefits,Skills will be handled separately

        // $job->apply_on = $request->receive_applications;
        $job->is_featured = $request->featured;
        $job->is_highlighted = $request->highlight;
        $job->description = $request->description;
        $job->save();


        // Insert Tags
        foreach ($request->tags as $tag) {
            $createTag = new JobTag();
            $createTag->job_id = $job->id;
            $createTag->tag_id = $tag;
            $createTag->save();
        }

        // Insert Benefits

        $benefits = explode(',', $request->benefits);
        foreach ($benefits as $benefit) {
            $createBenefit = new Benefits();
            $createBenefit->company_id = $job->company_id;
            $createBenefit->name = $benefit;
            $createBenefit->save();

            //store job benfit
            $jobBenefit = new JobBenefits();
            $jobBenefit->job_id = $job->id;
            $jobBenefit->benefit_id = $createBenefit->id;
            $jobBenefit->save();
        }



        // Insert Skills
        foreach ($request->skills as $skill) {
            $createSkill = new JobSkills();
            $createSkill->job_id = $job->id;
            $createSkill->skill_id = $skill;
            $createSkill->save();
        }


        // Decrement user plan limits
        if ($job) {
            $userPlan = auth()->user()->company?->userPlan;
            if ($userPlan) {
                $userPlan->job_limit = $userPlan->job_limit - 1;
                if ($job->is_featured == 1) {
                    $userPlan->featured_job_limit = $userPlan->featured_job_limit - 1;
                }
                if ($job->is_highlighted == 1) {
                    $userPlan->highlight_job_limit = $userPlan->highlight_job_limit - 1;
                }
                $userPlan->save();
                storePlanInformation();
            }
        }


        Notify::createdNotification();
        return to_route('company.jobs.index');
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
    // public function edit(string $id): View
    // {
    //     //
    //     $job = Job::findOrFail($id);
    //     abort_if();
    //     $companies = Company::where(['profile_completion' => 1, 'visibility' => 1])->get();
    //     $categories = JobCategory::all();
    //     $countries = Country::all();
    //     $states = State::where('country_id', $job?->country_id)->get();
    //     $cities = City::where('state_id', $job?->state_id)->get();
    //     $salaryTypes  = SalaryType::all();
    //     $experiences = JobExperience::all();
    //     $jobRoles = JobRole::all();
    //     $educations = Education::all();
    //     $jobTypes = JobType::all();
    //     $tags = Tag::all();
    //     $skills = Skill::all();
    //     return view('frontend.company-dashboard.job.edit', compact('companies', 'categories', 'countries', 'states', 'cities', 'salaryTypes', 'experiences', 'jobRoles', 'educations', 'jobTypes', 'tags', 'skills', 'job'));
    // }
    public function edit(string $id): View
    {
        // Find the job or fail with a 404 error
        $job = Job::findOrFail($id);

        // Ensure the authenticated user's company owns the job
        abort_if($job->company_id !== auth()->user()->company?->id, 403, 'You are not authorized to edit this job.');

        // Fetch necessary data for the form
        $categories = JobCategory::all();
        $countries = Country::all();
        $states = $job->country_id ? State::where('country_id', $job->country_id)->get() : collect();
        $cities = $job->state_id ? City::where('state_id', $job->state_id)->get() : collect();
        $salaryTypes = SalaryType::all();
        $experiences = JobExperience::all();
        $jobRoles = JobRole::all();
        $educations = Education::all();
        $jobTypes = JobType::all();
        $tags = Tag::all();
        $skills = Skill::all();

        // Return the view with the data
        return view('frontend.company-dashboard.job.edit', compact(
            'categories',
            'countries',
            'states',
            'cities',
            'salaryTypes',
            'experiences',
            'jobRoles',
            'educations',
            'jobTypes',
            'tags',
            'skills',
            'job'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobCreateRequest $request, string $id)
    {
        //
        $job = Job::findOrFail($id);
        $job->title = $request->title;
        $job->job_category_id = $request->category;
        $job->vacancies = $request->vacancies;
        $job->deadline = $request->deadline;

        $job->country_id = $request->country;
        $job->state_id = $request->state;
        $job->city_id = $request->city;
        $job->address = $request->address;


        $job->salary_mode = $request->salary_mode;
        $job->min_salary = $request->min_salary;
        $job->max_salary = $request->max_salary;
        $job->custom_salary = $request->custom_salary;
        $job->salary_type_id = $request->salary_type;

        $job->job_experience_id = $request->experience;
        $job->job_role_id = $request->job_role;
        $job->education_id = $request->education;
        $job->job_type_id = $request->job_type;

        //Tags, Benefits,Skills will be handled separately

        // $job->apply_on = $request->receive_applications;
        $job->is_featured = $request->featured;
        $job->is_highlighted = $request->highlight;
        $job->description = $request->description;
        $job->save();


        // Insert Tags
        JobTag::where('job_id', $id)->delete();
        foreach ($request->tags as $tag) {
            $createTag = new JobTag();
            $createTag->job_id = $job->id;
            $createTag->tag_id = $tag;
            $createTag->save();
        }

        // Insert Benefits
        $selectedBenefits = JobBenefits::where('job_id', $id);
        foreach ($selectedBenefits->get() as $selectedBenefit) {
            Benefits::find($selectedBenefit?->benefit_id)->delete();
        }

        $selectedBenefits->delete();

        $benefits = explode(',', $request->benefits);

        foreach ($benefits as $benefit) {
            $createBenefit = new Benefits();
            $createBenefit->company_id = $job->company_id;
            $createBenefit->name = $benefit;
            $createBenefit->save();

            //store job benfit
            $jobBenefit = new JobBenefits();
            $jobBenefit->job_id = $job->id;
            $jobBenefit->benefit_id = $createBenefit->id;
            $jobBenefit->save();
        }



        // Insert Skills
        JobSkills::where('job_id', $id)->delete();
        foreach ($request->skills as $skill) {
            $createSkill = new JobSkills();
            $createSkill->job_id = $job->id;
            $createSkill->skill_id = $skill;
            $createSkill->save();
        }

        Notify::updatedNotification();
        return to_route('company.jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            Job::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
