<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPageBuilder;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomPageBuilderController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $query = CustomPageBuilder::query();

        $this->search($query, ['page_name', 'slug', 'content', 'updated_at']);

        $pages = $query->latest()->paginate(10);

        return view('admin.page-builder.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('admin.page-builder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $this->validate($request, [
            'page_name' => ['required', 'string', 'max:255'],
            'content' => ['required'],
        ]);

        $page = new CustomPageBuilder();
        $page->page_name = $request->page_name;
        $page->content = $request->content;
        $page->save();

        Notify::createdNotification();
        return redirect()->route('admin.page-builder.index')->with('success','Custom Page Created Successfully!');
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
        $page = CustomPageBuilder::findOrFail($id);
        return view('admin.page-builder.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'page_name'=> ['required', 'string'],
            'content'=> ['required'],
            ]);
            $page = CustomPageBuilder::findOrFail($id);
            $page->page_name = $request->page_name;
            $page->content = $request->content;
            $page->save();
            Notify::updatedNotification();
            return redirect()->route('admin.page-builder.index')->with('success','Custom Page Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            CustomPageBuilder::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
