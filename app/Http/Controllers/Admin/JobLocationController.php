<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobLocationRequest;
use App\Models\Country;
use App\Models\JobLocation;
use App\Models\State;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobLocationController extends Controller
{
    use FileUploadTrait, Searchable;

function __construct()
    {
        $this->middleware(['permission:job sections']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = JobLocation::query()
            ->leftJoin('countries', 'job_locations.country_id', '=', 'countries.id')
            ->leftJoin('states', 'job_locations.state_id', '=', 'states.id')
            ->select('job_locations.*'); // Important to avoid column conflicts

        $this->search($query, ['countries.name', 'states.name', 'job_locations.status']);

        $jobLocations = $query->orderBy('job_locations.created_at', 'DESC')->paginate(10);

        return view('admin.job-location.index', compact('jobLocations'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $countries = Country::all();

        return view('admin.job-location.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobLocationRequest $request)
    {
        //
        $imagePath = $this->uploadFile($request, 'image');
        $jobLocation = new JobLocation();
        $jobLocation->image = $imagePath;
        $jobLocation->country_id = $request->country;
        $jobLocation->state_id = $request->state;

        $jobLocation->status = $request->status;
        $jobLocation->save();

        Notify::createdNotification();
        return to_route('admin.job-location.index')->with('success', 'Job Location Created Successfully');
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
        $jobLocation = JobLocation::findOrFail($id);
        $countries = Country::all();
        $states = State::all();

        return view('admin.job-location.edit', compact('jobLocation', 'countries', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'image' => 'nullable',
            'country'   => 'required',
            'status' => 'required',
        ]);

        $jobLocation = JobLocation::findOrFail($id);
        $imagePath = $this->uploadFile($request, 'image');
        if ($imagePath) $jobLocation->image = $imagePath;

        $jobLocation->country_id = $request->country;
        $jobLocation->state_id = $request->state;

        $jobLocation->status = $request->status;
        $jobLocation->save();

        Notify::updatedNotification();
        return to_route('admin.job-location.index')->with('success', 'Job Location Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            JobLocation::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
