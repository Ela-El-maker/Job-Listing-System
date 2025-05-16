<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialIcon;
use App\Services\Notify;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialIconController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:Site footer']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $socialIcons = SocialIcon::paginate(10);
        return view('admin.footer.index-socials', compact('socialIcons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('admin.footer.create-socials');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'url' => 'required|max:2048',
        ]);

        $socialIcon = new SocialIcon();
        $socialIcon->icon = $request->icon;
        $socialIcon->url = $request->url;
        $socialIcon->save();

        Notify::createdNotification(); // Assuming this is a custom notification helper

        return redirect()
            ->route('admin.social-icon.index')
            ->with('success', 'Social icon created successfully.');
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
        $socialIcon = SocialIcon::findOrFail($id);
        return view('admin.footer.edit-socials', compact('socialIcon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'url' => 'required|max:2048',
        ]);

        $socialIcon = SocialIcon::findOrFail($id);

        if ($request->filled('icon')) {
            $socialIcon->icon = $request->icon;
        }

        $socialIcon->url = $request->url;
        $socialIcon->save();

        Notify::updatedNotification(); // Prefer "updated" over "created" for semantic clarity

        return redirect()
            ->route('admin.social-icon.index')
            ->with('success', 'Social icon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         try {
            SocialIcon::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
