<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller

{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Admin::query(); // Start with a query builder instance

        $this->search($query, ['name', 'email', 'created_at', 'updated_at']); // Apply search filters

        $admins = $query->latest()->paginate(10); // Apply ordering and paginate

        return view('admin.access-management.role-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        // $roles = Role::all();
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.access-management.role-user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'confirmed'],
            'role' => ['required']
        ]);

        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Assign Role
        $user->assignRole($request->role);

        Notify::createdNotification();

        return to_route('admin.role-user.index');
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
        $user = Admin::with('roles', 'permissions')->findOrFail($id);
        $roles = Role::where('guard_name', 'admin')->get();
        // $permissions = Permission::all()->groupBy('group');

        return view('admin.access-management.role-user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'unique:admins,email,' . $id],
            'password' => ['nullable', 'confirmed'],
            'role' => ['required', 'exists:roles,name']
        ]);

        $user = Admin::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Assign Role - Correct method is syncRoles() not syncRole()
        $user->syncRoles([$request->role]);

        Notify::updatedNotification(); // Changed from createdNotification to updatedNotification

        return to_route('admin.role-user.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);

        try {

            if ($admin->getRoleNames()->first() === 'Super Admin') {
                return response(['message' => 'You Can\'t Delete the Super Admin'], 500);
            }
            Admin::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }
}
