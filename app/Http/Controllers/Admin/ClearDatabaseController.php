<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class ClearDatabaseController extends Controller
{
    //

       function __construct()
    {
        $this->middleware(['permission:database clear']);
    }

    function index(): View
    {
        return view('admin.clear-database.index');
    }

    function clearDatabase()
    {
        // dd('ok');
        try {
            //code...
            // Wipe DB data
            Artisan::call('migrate:fresh');
            // Seed default data
            Artisan::call('db:seed', ['--class' => 'RolePermissionSeeder']);
            Artisan::call('db:seed', ['--class' => 'AdminSeeder']);
            Artisan::call('db:seed', ['--class' => 'SiteSettingSeeder']);
            Artisan::call('db:seed', ['--class' => 'MenuSeeder']);
            Artisan::call('db:seed', ['--class' => 'PaymentSettingSeeder']);


            // Delete files
            $this->deleteFiles();

            return response(['message'=>'Database wiped Successfully!!!']);
        } catch (\Exception $e) {
            throw $e;
        }
    }


    function deleteFiles(): void
    {
        $path = public_path('uploads');
        $allFiles = File::allFiles($path);

        foreach ($allFiles as $file) {
            $fileName = $file->getFilename();
            File::delete($fileName);
        }
    }
}
