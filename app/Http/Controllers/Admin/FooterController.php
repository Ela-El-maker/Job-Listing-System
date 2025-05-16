<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FooterController extends Controller
{
    use FileUploadTrait;
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
        $footer = Footer::first();
        return view('admin.footer.index', compact('footer'));
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
        $imagePath = $this->uploadFile($request, 'logo');
        $data = [
                'details' => $request->details,
                'copyright' => $request->copyright
        ];

        if($imagePath) {
            $data['logo'] = $imagePath;
        }

        Footer::updateOrCreate(
            [
                'id' => 1
            ],
            $data
        );

        Notify::updatedNotification();
        return redirect()->back()->with('success','Successfully updated the footer!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
