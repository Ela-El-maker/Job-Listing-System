<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use App\Models\Blog;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use App\Traits\Searchable;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    use FileUploadTrait, Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Blog::query();

        $this->search($query, ['title', 'slug', 'created_at', 'updated_at']);

        $blogs = $query->where('status', 1)->latest()->paginate(10);

        //
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        //
        // dd($request);
        $imagePath = $this->uploadFile($request, 'image');
        $blog = new Blog();
        $blog->image = $imagePath;
        $blog->title = $request->title;
        $blog->author_id = auth()->user()->id;
        $blog->description = $request->description;
        $blog->status = $request->status;
        $blog->featured = $request->featured;

        $blog->save();
        Notify::createdNotification();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
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
        $blog = Blog::find($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, string $id)
    {
        // dd($request);
        $imagePath = $this->uploadFile($request, 'image');
        $blog = Blog::findorfail($id);
        if ($imagePath) $blog->image = $imagePath;
        $blog->title = $request->title;
        $blog->author_id = auth()->user()->id;
        $blog->description = $request->description;
        $blog->status = $request->status;
        $blog->featured = $request->featured;
        $blog->save();
        Notify::updatedNotification();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog Updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            Blog::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
