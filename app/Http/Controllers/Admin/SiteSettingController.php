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
    function index() : View {

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
      $settingService = app(SiteSettingService::class);
      $settingService ->clearCacheSettings();

      Notify::updatedNotification();
      return redirect()->back();
  }
}
