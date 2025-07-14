<?php

namespace App\Services;

use App\Jobs\ProcessDeleteImage;
use App\Models\Doctor;
use App\Models\SpecialCase;
use App\Jobs\ProcessImageUploade;
use Illuminate\Routing\Controller;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\uploadImageTrait;
use App\Http\Requests\SpecialCaseRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Request;

class SpecialCaseService extends Controller
{
    use uploadImageTrait;

    public function createSpecialCase(array $data, SpecialCaseRequest $request)
    {

        $data['before_image'] = " ";
        $data['after_image'] = " ";
        // Handle boolean field
        $data['is_special_case'] = isset($data['is_special_case']) ? 1 : 0;

        $data['doctor_name'] = Doctor::find($data['doctor_id'])->name;


        // Save to database
        $case = SpecialCase::create($data);


        // Handle file uploads
        if ($request->has('before_image')) {
            # V1
            // $data['before_image'] = $data['before_image']->store('cases/before_images', 'public');

            #V2
            // $imageToUploadArray = $this->uploadImage($request, null, 'cases/before_images', 'before_image');
            // $data['before_image'] = $imageToUploadArray['imageURL'] ;
            // $data['cloudinary_public_id_before'] = $imageToUploadArray['cloudinary_public_id'];

            #V3
            $file = $request->file('before_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('temp_uploads', $filename, 'local'); // storage/app/temp_uploads/xxx.jpg
            $fullPath = storage_path('app/private/' . $path);
            ProcessImageUploade::dispatch($case, $fullPath, 'cases/before_images' , 'before_image' , 'cloudinary_public_id_before');

        }

        if ($request->has('after_image')) {
            #V1
            // $data['after_image'] = $data['after_image']->store('cases/after_images', 'public');

            #V2
            // $imageToUploadArray = $this->uploadImage($request, null, 'cases/after_images', 'after_image');
            // $data['after_image'] = $imageToUploadArray['imageURL'];
            // $data['cloudinary_public_id_after'] = $imageToUploadArray['cloudinary_public_id'];

            #V3
            $file = $request->file('after_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('temp_uploads', $filename, 'local'); // storage/app/temp_uploads/xxx.jpg
            $fullPath = storage_path('app/private/' . $path);
            ProcessImageUploade::dispatch($case, $fullPath, 'cases/after_images' ,  'after_image' , 'cloudinary_public_id_after');

        }


    }

    public function updateSpecialCase(array $data, SpecialCaseRequest $request , SpecialCase $case)
    {

        $data['doctor_name'] = Doctor::find($data['doctor_id'])->name;
        $data['is_special_case'] = $request->has('is_special_case') ? 1 : 0;


        // Save to database
        $case->update($data);


        // Handle file uploads
        if ($request->has('before_image')) {
            # V1
            // $data['before_image'] = $data['before_image']->store('cases/before_images', 'public');

            #V2
            // $imageToUploadArray = $this->uploadImage($request, null, 'cases/before_images', 'before_image');
            // $data['before_image'] = $imageToUploadArray['imageURL'] ;
            // $data['cloudinary_public_id_before'] = $imageToUploadArray['cloudinary_public_id'];

            #V3
            $file = $request->file('before_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('temp_uploads', $filename, 'local'); // storage/app/temp_uploads/xxx.jpg
            $fullPath = storage_path('app/private/' . $path);
            ProcessImageUploade::dispatch($case, $fullPath, 'cases/before_images' , 'before_image' , 'cloudinary_public_id_before');

        }

        if ($request->has('after_image')) {
            #V1
            // $data['after_image'] = $data['after_image']->store('cases/after_images', 'public');

            #V2
            // $imageToUploadArray = $this->uploadImage($request, null, 'cases/after_images', 'after_image');
            // $data['after_image'] = $imageToUploadArray['imageURL'];
            // $data['cloudinary_public_id_after'] = $imageToUploadArray['cloudinary_public_id'];

            #V3
            $file = $request->file('after_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('temp_uploads', $filename, 'local'); // storage/app/temp_uploads/xxx.jpg
            $fullPath = storage_path('app/private/' . $path);
            ProcessImageUploade::dispatch($case, $fullPath, 'cases/after_images' ,  'before_image' , 'cloudinary_public_id_before');

        }


    }

    public function deleteCaseWithImages(SpecialCase $case): void
    {
        $case->delete();


        if ($case->cloudinary_public_id_before) {
            #V2
            // (new UploadApi())->destroy($case->cloudinary_public_id_before);

            #V3
            ProcessDeleteImage::dispatch($case->cloudinary_public_id_before);
        }

        if ($case->cloudinary_public_id_after) {
            #V2
            // (new UploadApi())->destroy($case->cloudinary_public_id_after);

            #V3
            ProcessDeleteImage::dispatch($case->cloudinary_public_id_after);
        }

    }
}
