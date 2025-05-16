<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\IndustryType;
use App\Models\Job;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class IndustryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Searchable;
    function __construct()
    {
        $this->middleware(['permission:job attributes']);
    }
    public function index(Request $request): View
    {
        //
        // dd($request->search);
        $query = IndustryType::query();

        $this->search($query, ['name']);

        $industryTypes = $query->paginate(10);

        return view('admin.industry-type.index', compact('industryTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('admin.industry-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:255', 'unique:industry_types,name'],
        ]);
        $type = new IndustryType();
        $type->name = $request->name;
        $type->save();
        Notify::createdNotification();
        return to_route('admin.industry-types.index');
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
        $industryType = IndustryType::findOrFail($id);
        return view('admin.industry-type.edit', compact('industryType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => ['required', 'max:255', 'unique:industry_types,name,' . $id],
        ]);
        $type = IndustryType::findorfail($id);
        $type->name = $request->name;
        $type->save();
        Notify::updatedNotification();
        return to_route('admin.industry-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        //
        // dd($id);
        $company = Company::where('industry_type_id', $id)->exists();
        if($company){
            return response(['message'=> 'This item is already being used. Can\'t Delate'],500);
        }
        try {
            IndustryType::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
