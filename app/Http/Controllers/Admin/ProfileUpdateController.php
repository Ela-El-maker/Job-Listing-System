<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileUpdateController extends Controller
{
    //
    use FileUploadTrait;

    function index(): View
    {
        $admin = auth()->guard('admin')->user();
        return view('admin.profile.index', compact('admin'));
    }


    function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['email', 'required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3048']
        ]);


        // dd($request->all());
        $imagePath = $this->uploadFile($request, 'image');
        $admin = auth()->guard('admin')->user();
        if ($imagePath) $admin->image = $imagePath;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();




        Notify::updatedNotification();

        return redirect()->back()->with('success', 'Admin Profile Updated Successfully!');
    }


    function passwordUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password:admin'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $admin = auth()->guard('admin')->user();
        $admin->password = bcrypt($request->password);
        $admin->save();

        Notify::updatedNotification();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}
