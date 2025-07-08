<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Enum\PermissionsEnum;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    use uploadImageTrait;

    public function __construct()
    {
        $this->middleware('permission:' . PermissionsEnum::settings->value)->only(['index', 'update']);
    }


    public function index()
    {
        $setting = Setting::first();
        return view('admin.site-settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $validator = $request->validate([
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'facebook' => 'required|url|max:255',
            'email' => 'nullable|email|max:100',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',


            'google_map_location' => 'url',
            'our_story' => 'string|required',
            'about_us_image' => 'image'
        ]);




        $settings = Setting::first();
        $image_path = $this->uploadImage($request, $settings, 'uploads/About-Us', 'about_us_image');
        $validator['about_us_image'] = $image_path;

        // dd($validator);

        if (!$settings) {

            $settings = Setting::create($validator);
            Cache::forget('site_settings');
            Cache::rememberForever('site_settings', fn() => $settings->fresh()->toArray());

        } else {
            Storage::disk('public')->delete($settings->about_us_image);
            $settings->update($validator);
            $settings->save();


            Cache::forget('site_settings');
            Cache::rememberForever('site_settings', fn() => $settings->fresh()->toArray());
            // Cache::rememberForever('site_settings', function () {
            //     return Setting::first()->toArray();
            // });
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully');
    }
}
