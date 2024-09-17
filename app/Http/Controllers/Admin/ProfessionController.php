<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Searchable;
    public function index() : View
    {
        //
         // dd($request->search);
         $query = Profession::query();
         $this->search($query,['name']);
         $professions = $query->paginate(10);
        return view('admin.professions.index', compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        //
        return view('admin.professions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:255', 'unique:professions,name'],
        ]);
        $profession = new Profession();
        $profession->name = $request->name;
        $profession->save();
        Notify::createdNotification();
        return to_route('admin.professions.index');
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
        $profession = Profession::findOrFail($id);
        return view('admin.professions.edit', compact('profession'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:255', 'unique:professions,name'],
        ]);
        $profession = Profession::findOrFail($id);
        $profession->name = $request->name;
        $profession->save();
        Notify::updatedNotification();
        return to_route('admin.professions.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        //
        // dd($id);
        try {
            Profession::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
