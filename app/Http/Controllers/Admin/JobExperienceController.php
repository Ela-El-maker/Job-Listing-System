<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobExperience;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobExperienceController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $query = JobExperience::query();

        $this->search($query, ['name', 'slug']);

        $jobExperiences = $query->paginate(10);
        return view('admin.job.job-experience.index', compact('jobExperiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('admin.job.job-experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $jobExperience = new JobExperience();
        $jobExperience->name = $request->name;
        $jobExperience->save();

        Notify::createdNotification();

        return to_route('admin.job-experience.index')->with('success', 'Job Experience added successfully');
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
    public function edit(string $id): View
    {
        //
        $jobExperience = JobExperience::find($id);
        return view('admin.job.job-experience.edit', compact('jobExperience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $jobExperience = JobExperience::findOrFail($id);
        $jobExperience->name = $request->name;
        $jobExperience->save();

        Notify::updatedNotification();

        return to_route('admin.job-experience.index')->with('success', 'Job Experience Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            JobExperience::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
