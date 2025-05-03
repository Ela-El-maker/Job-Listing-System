<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientReviewController extends Controller
{
    use FileUploadTrait, Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Start the query on the ClientReview model
        $query = ClientReview::query(); // Select only necessary fields





        $query = ClientReview::query();

        $this->search($query, ['name', 'rating', 'created_at', 'title']);

        // Apply ordering and pagination
        $clientReviews = $query->orderBy("created_at", "desc")->paginate(10);


        return view('admin.reviews.index', compact('clientReviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('admin.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,webm|max:4000',
        ]);

        $imagePath = $this->uploadFile($request, 'image');

        $review = new ClientReview();
        $review->name = $validated['name'];
        $review->title = $validated['title'];
        $review->rating = $validated['rating'];
        $review->review = $validated['review'];
        $review->image = $imagePath;

        $review->save();

        Notify::createdNotification();

        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        //
        $review = ClientReview::findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        //
        $review = ClientReview::findOrFail($id);
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,webm|max:4000',
        ]);

        $imagePath = $this->uploadFile($request, 'image');

        $review =  ClientReview::findOrFail($id);
        $review->name = $validated['name'];
        $review->title = $validated['title'];
        $review->rating = $validated['rating'];
        $review->review = $validated['review'];
        if ($imagePath) $review->image = $imagePath;


        $review->save();

        Notify::updatedNotification();

        return redirect()->route('admin.reviews.index')->with('success', 'Review Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            ClientReview::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
