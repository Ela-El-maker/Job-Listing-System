<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobRole;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobRoleController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $query = JobRole::query();

        $this->search($query, ['name', 'slug']);

        $jobRoles = $query->paginate(10);
        return view('admin.job.job-role.index', compact('jobRoles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('admin.job.job-role.create');
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

        $jobRole = new JobRole();
        $jobRole->name = $request->name;
        $jobRole->save();

        Notify::createdNotification();

        return to_route('admin.job-role.index')->with('success', 'Job Role added successfully');
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
        $jobRole = JobRole::find($id);
        return view('admin.job.job-role.edit', compact('jobRole'));
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

        $jobRole = JobRole::findOrFail($id);
        $jobRole->name = $request->name;
        $jobRole->save();

        Notify::updatedNotification();

        return to_route('admin.job-role.index')->with('success', 'Job Role Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            JobRole::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
