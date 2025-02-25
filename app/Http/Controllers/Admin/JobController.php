<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobCreateRequest;
use App\Models\Company;
use App\Models\Country;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobExperience;
use App\Models\JobRole;
use App\Models\JobType;
use App\Models\SalaryType;
use App\Models\Skill;
use App\Models\Tag;
use App\Services\Notify;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        return view('admin.job.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
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
        return view('admin.job.create', compact('companies', 'categories', 'countries', 'salaryTypes', 'experiences', 'jobRoles', 'educations', 'jobTypes', 'tags', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCreateRequest $request)
    {
        //
        // dd($request->all());
        $job = new Job();
        $job->title = $request->title;
        $job->company_id = $request->company;
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

        Notify::createdNotification();
        return to_route('admin.jobs.index');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
