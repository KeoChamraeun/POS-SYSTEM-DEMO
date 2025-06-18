<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class SiteSettingController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::first();
        return view('admin.site_setting.index', compact('siteSettings'));
    }

    public function edit($id)
    {
        $siteSettings = SiteSetting::find($id);
        return view('admin.site_setting.edit', compact('siteSettings'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $siteSettings = SiteSetting::find($id);
        $siteSettings->site_title = $request->site_title;
        $siteSettings->company_name = $request->company_name;
        $siteSettings->address = $request->address;
        $siteSettings->site_phone = $request->site_phone;
        $siteSettings->site_email = $request->site_email;
        $siteSettings->currency = $request->currency;
        $siteSettings->footer_text = $request->footer_text;

        
        if ($request->hasFile('site_logo')) {
            // Delete old logo if exists
            if ($siteSettings->site_logo && file_exists(public_path($siteSettings->site_logo))) {
                unlink(public_path($siteSettings->site_logo));
            }
            $site_logo = $request->file('site_logo');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $site_logo->getClientOriginalExtension();
            $image = $manager->read($site_logo);
            $save_url = '/uploads/site_settings/' . $name_gen;
            $image->save(public_path($save_url));
            $siteSettings->site_logo = $save_url;
        }

        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($siteSettings->favicon && file_exists(public_path($siteSettings->favicon))) {
                unlink(public_path($siteSettings->favicon));
            }
            $favicon = $request->file('favicon');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $favicon->getClientOriginalExtension();
            $image = $manager->read($favicon);
            $save_url = '/uploads/site_settings/' . $name_gen;
            $image->save(public_path($save_url));
            $siteSettings->favicon = $save_url;
        }


        $siteSettings->facebook = $request->facebook;
        $siteSettings->twitter = $request->twitter;
        $siteSettings->linkedin = $request->linkedin;
        $siteSettings->instagram = $request->instagram;
        $siteSettings->save();

        return redirect()->route('site.setting.index')->with('success', 'Site Setting Updated Successfully');
    }
}
