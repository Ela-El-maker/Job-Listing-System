<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobCategoryController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        // dd($request->search);
        $query = JobCategory::query();

        $this->search($query, ['name', 'slug']);

        $jobCategories = $query->paginate(10);
        return view('admin.job.job-category.index', compact('jobCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('admin.job.job-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $request->validate([
            'icon' =>  ['required', 'max:255'],
            'name' => ['required', 'max:255'],
        ]);

        $category = new JobCategory();
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->show_at_popular = $request->show_at_popular;
        $category->show_at_featured = $request->show_at_featured;
        $category->save();

        Notify::createdNotification();

        return to_route('admin.job-categories.index');
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
        $jobCategory = JobCategory::findOrFail($id);
        return view('admin.job.job-category.edit', compact('jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
        $request->validate([
            'icon' =>  ['nullable', 'max:255'],
            'name' => ['required', 'max:255'],
        ]);

        $category = JobCategory::findOrFail($id);
        if ($request->filled('icon')) $category->icon = $request->icon;
        $category->name = $request->name;
        $category->show_at_popular = $request->show_at_popular;
        $category->show_at_featured = $request->show_at_featured;

        $category->save();

        Notify::updatedNotification();

        return to_route('admin.job-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $jobExists = Job::where('job_category_id',$id)->exists();
        if($jobExists)
        {
            return response(['message' => 'This item is already being used. Can\'t Delete'],500);
        }
        try {
            JobCategory::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
