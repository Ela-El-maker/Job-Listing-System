<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettingUpdateRequest;
use App\Models\SiteSetting;
use App\Services\Notify;
use App\Services\SiteSettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    //

       function __construct()
    {
        $this->middleware(['permission:site settings']);
    }

    function index() : View
    {
        return view('admin.site-setting.index');
    }

    function updateGeneralSetting(GeneralSettingUpdateRequest $request) : RedirectResponse
    {
        // dd($request->all());
        $validatedData = $request -> validated();
        // dd($validatedData);
        foreach ($validatedData as $key => $value) {
            # code...
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $siteSetting = app()->make(SiteSettingService::class);
        $siteSetting->clearCacheSettings();

        Notify::updatedNotification();
        return redirect()->back();
    }


    function updateLogoSetting(Request $request): RedirectResponse
    {
        $request->validate([
            'logo' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
            'favicon' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000']
        ]);

        try {
            $logoPath = $this->uploadFile($request, 'logo');
            if ($logoPath === '') {
                throw new \Exception('Logo upload failed');
            }

            $faviconPath = $this->uploadFile($request, 'favicon');
            if ($faviconPath === '') {
                throw new \Exception('Favicon upload failed');
            }

            // Update logo
            if ($logoPath) {
                SiteSetting::updateOrCreate(
                    ['key' => 'site_logo'],
                    ['value' => $logoPath]
                );
            }

            // Update favicon
            if ($faviconPath) {
                SiteSetting::updateOrCreate(
                    ['key' => 'site_favicon'],
                    ['value' => $faviconPath]
                );
            }

            $siteSetting = app()->make(SiteSettingService::class);
            $siteSetting->clearCacheSettings();

            Notify::updatedNotification();
            return redirect()->back();
        } catch (\Exception $e) {
            Notify::errorNotification($e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
