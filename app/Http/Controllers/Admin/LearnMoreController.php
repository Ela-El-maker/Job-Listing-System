<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearnMore;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearnMoreController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //
        $learn = LearnMore::first();
        return view('admin.learn-more.index', compact('learn'));
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
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,webm,svg|max:4000',
            'title' => ['nullable'  ,'max:255'],
            'sub_title' => ['nullable' ],
            'main_title' => ['nullable'  ,'max:255'],
            'url' => ['nullable','url','max:255'],
        ]);

      // Assuming you have a Hero model and you're updating it
      $imagePath = $this->uploadFile($request, 'image');

      $formData = [];
      $formData['title'] = $request->title;
      $formData['sub_title'] = $request->sub_title;
      $formData['main_title'] = $request->main_title;
      $formData['url'] = $request->url;

      // If a new image is uploaded, use it; otherwise, keep the old one
      if ($imagePath) {
          $formData['image'] = $imagePath;
      } else {
          $formData['image'] = LearnMore::find($id)->image; // Keep old image if no new one is uploaded
      }

      // Update or create the Learn record
      LearnMore::updateOrCreate(
          ['id' => $id], // Find the hero by ID or create a new one
          $formData // The data to update or create
      );

      Notify::updatedNotification();
      return redirect()->back()->with('success', 'Learn More section updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
