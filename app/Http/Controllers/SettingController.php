<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Toastr;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index()
    {
        $setting = Setting::first();

        return view('admin.settings.setting',compact('setting'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $setting = Setting::first();

        $setting->site_name = $request->site_name;
        $setting->contact_number = $request->contact_number;
        $setting->contact_email  = $request->contact_email;
        $setting->address = $request->address;
        $setting->save();

        Toastr::success('Setting updated.');

        return redirect(route('setting'));
    }
}
