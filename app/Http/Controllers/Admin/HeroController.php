<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroController extends Controller
{
    use FileUploadTrait;

    function __construct()
    {
        $this->middleware(['permission:job sections']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $hero = Hero::first(); // Get the first hero record, or null if none exists
        return view('admin.hero.index', compact('hero'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        // dd($request->all(), $id);
        // Here you would typically validate the request data and update the hero record in the database.
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,webm,svg|max:4000', // Ensure the image is valid
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,webm,svg|max:4000', // Ensure the image is valid
        ]);

        // Assuming you have a Hero model and you're updating it
        $imagePath = $this->uploadFile($request, 'image');
        $backgroundImagePath = $this->uploadFile($request, 'background_image');

        $formData = [];
        $formData['title'] = $request->title;
        $formData['sub_title'] = $request->sub_title;
        // If a new image is uploaded, use it; otherwise, keep the old one
        if ($imagePath) {
            $formData['image'] = $imagePath;
        } else {
            $formData['image'] = Hero::find($id)->image; // Keep old image if no new one is uploaded
        }
        // If a new background image is uploaded, use it; otherwise, keep the old one
        if ($backgroundImagePath) {
            $formData['background_image'] = $backgroundImagePath;
        } else {
            $formData['background_image'] = Hero::find($id)->background_image; // Keep old background image if no new one is uploaded
        }
        // Update or create the hero record
        Hero::updateOrCreate(
            ['id' => $id], // Find the hero by ID or create a new one
            $formData // The data to update or create
        );

        Notify::updatedNotification();
        return redirect()->back()->with('success', 'Hero section updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
