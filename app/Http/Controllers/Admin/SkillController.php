<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Searchable;
    public function index() : View
    {
        //
         // dd($request->search);
         $query = Skill::query();
         $this->search($query,['name']);
         $skills = $query->paginate(10);
        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('admin.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:255', 'unique:skills,name'],
        ]);
        $skill = new Skill();
        $skill->name = $request->name;
        $skill->save();
        Notify::createdNotification();
        return to_route('admin.skills.index');
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
        $skill = Skill::findOrFail($id);
        return view('admin.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:255', 'unique:skills,name'],
        ]);
        $skill = Skill::findOrFail($id);
        $skill->name = $request->name;
        $skill->save();
        Notify::updatedNotification();
        return to_route('admin.skills.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        //
        // dd($id);
        try {
            Skill::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
