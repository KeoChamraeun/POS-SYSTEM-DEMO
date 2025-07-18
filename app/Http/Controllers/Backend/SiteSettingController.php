<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SiteSettingController extends Controller
{
    // Show site settings list (only current user's)
    public function index()
    {
        $userId = auth()->id();

        // Get the first SiteSetting for the user (if any)
        $siteSettings = SiteSetting::where('user_id', $userId)->first();

        return view('admin.site_setting.index', compact('siteSettings'));
    }

    // Show form to create if none exists
    public function create()
    {
        return view('admin.site_setting.create');
    }

    // Store new site setting
    public function store(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'site_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            // Add other validation as needed
        ]);

        $siteSettings = new SiteSetting();
        $siteSettings->user_id = $userId; // assign to logged in user
        $siteSettings->site_title = $request->site_title;
        $siteSettings->company_name = $request->company_name;
        $siteSettings->address = $request->address;
        $siteSettings->site_phone = $request->site_phone;
        $siteSettings->site_email = $request->site_email;
        $siteSettings->currency = $request->currency;
        $siteSettings->footer_text = $request->footer_text;
        $siteSettings->facebook = $request->facebook;
        $siteSettings->twitter = $request->twitter;
        $siteSettings->linkedin = $request->linkedin;
        $siteSettings->instagram = $request->instagram;

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $site_logo = $request->file('site_logo');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $site_logo->getClientOriginalExtension();
            $image = $manager->read($site_logo);
            $save_url = '/uploads/site_settings/' . $name_gen;
            $image->save(public_path($save_url));
            $siteSettings->site_logo = $save_url;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $favicon->getClientOriginalExtension();
            $image = $manager->read($favicon);
            $save_url = '/uploads/site_settings/' . $name_gen;
            $image->save(public_path($save_url));
            $siteSettings->favicon = $save_url;
        }

        $siteSettings->save();

        return redirect()->route('site.setting.index')->with('success', 'Site setting created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $userId = auth()->id();

        // Ensure the setting belongs to the user
        $siteSettings = SiteSetting::where('id', $id)->where('user_id', $userId)->firstOrFail();

        return view('admin.site_setting.edit', compact('siteSettings'));
    }

    // Update site setting
    public function update(Request $request, $id)
    {
        $userId = auth()->id();

        $siteSettings = SiteSetting::where('id', $id)->where('user_id', $userId)->firstOrFail();

        $siteSettings->site_title = $request->site_title;
        $siteSettings->company_name = $request->company_name;
        $siteSettings->address = $request->address;
        $siteSettings->site_phone = $request->site_phone;
        $siteSettings->site_email = $request->site_email;
        $siteSettings->currency = $request->currency;
        $siteSettings->footer_text = $request->footer_text;
        $siteSettings->facebook = $request->facebook;
        $siteSettings->twitter = $request->twitter;
        $siteSettings->linkedin = $request->linkedin;
        $siteSettings->instagram = $request->instagram;

        // Update logo if uploaded
        if ($request->hasFile('site_logo')) {
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

        // Update favicon if uploaded
        if ($request->hasFile('favicon')) {
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

        $siteSettings->save();

        return redirect()->route('site.setting.index')->with('success', 'Site setting updated successfully.');
    }
}
