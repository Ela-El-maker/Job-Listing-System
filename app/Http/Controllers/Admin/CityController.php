<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CityController extends Controller
{
     function __construct()
    {
        $this->middleware(['permission:job locations']);
    }


    /**
     * Display a listing of the resource.
     */
    use Searchable;
    public function index(): View
    {
        //
        $query = City::query();
        $query->with(['country', 'state']);
        $this->search($query, ['name']);

        $cities = $query->orderBy('id', 'DESC')->paginate(10);
        return view('admin.location.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $countries = Country::all();
        $states = State::all();

        return view('admin.location.city.create', compact('countries', 'states'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        //
        // dd($request->all());
        $request->validate([
            'country' => ['required', 'integer'],
            'state' => ['required', 'integer'],
            'city' => ['required','string', 'max:255'],
        ]);
        $city = new City();
        $city->name = $request->city;
        $city->state_id = $request->state;
        $city->country_id = $request->country;
        $city->save();
        Notify::createdNotification();
        return to_route('admin.cities.index');
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
    public function edit(string $id) : View
    {
        //
        $city = City::findorfail($id);
        $countries = Country::all();
        $states = State::where('country_id', $city->country_id)->get();

        return view('admin.location.city.edit', compact('countries', 'city', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {
        //
        // dd($request->all());
        $request->validate([
            'country' => ['required', 'integer'],
            'state' => ['required', 'integer'],
            'city' => ['required','string', 'max:255'],
        ]);
        $city = City::findorfail($id);
        $city->name = $request->city;
        $city->state_id = $request->state;
        $city->country_id = $request->country;
        $city->save();
        Notify::updatedNotification();
        return to_route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        //
        try {
            City::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
