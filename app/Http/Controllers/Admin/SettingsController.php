<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Enum\PermissionsEnum;
use App\Jobs\ProcessImageUploade;
use Illuminate\Routing\Controller;
use Cloudinary\Api\Upload\UploadApi;
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

        #V1
        // $image_path = $this->uploadImage($request, $settings, 'uploads/About-Us', 'about_us_image');
        #V2
        // $imageToUploadArray = $this->uploadImage($request, $settings, 'settings/images', "about_us_image");
        // $validator['about_us_image'] = $imageToUploadArray['imageURL'];
        // $validator['cloudinary_public_id'] = $imageToUploadArray['cloudinary_public_id'];
        #V3
        if ($request->hasFile('about_us_image')) {
            $file = $request->file('about_us_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('temp_uploads', $filename, 'local'); // storage/app/temp_uploads/xxx.jpg
            $fullPath = storage_path('app/private/' . $path);
            // Queue the image upload job
            ProcessImageUploade::dispatch($settings, $fullPath, 'settings/images', 'about_us_image', 'cloudinary_public_id');
        }


        if (!$settings) {
            $settings = Setting::create($validator);
            Cache::forget('site_settings');
            Cache::rememberForever('site_settings', fn() => $settings->fresh()->toArray());

        } else {
            if ($settings->cloudinary_public_id) {
                (new UploadApi())->destroy($settings->cloudinary_public_id);
            }
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
