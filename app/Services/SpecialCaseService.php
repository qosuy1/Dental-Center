<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\SpecialCase;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\uploadImageTrait;
use Cloudinary\Api\Upload\UploadApi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class SpecialCaseService extends Controller
{
    use uploadImageTrait;

    public function createSpecialCase(array $data, $request = null): SpecialCase
    {
        // Handle file uploads
        if (isset($data['before_image'])) {
            // $data['before_image'] = $data['before_image']->store('cases/before_images', 'public');
            $imageToUploadArray = $this->uploadImage($request, null, 'cases/before_images', 'before_image');
            $data['before_image'] = $imageToUploadArray['imageURL'] ;
            $data['cloudinary_public_id_before'] = $imageToUploadArray['cloudinary_public_id'];
        }

        if (isset($data['after_image'])) {
            // $data['after_image'] = $data['after_image']->store('cases/after_images', 'public');
            // $data['after_image'] = $this->uploadImage($request, null, 'cases/after_images', 'after_image');

            $imageToUploadArray = $this->uploadImage($request, null, 'cases/after_images', 'after_image');
            $data['after_image'] = $imageToUploadArray['imageURL'];
            $data['cloudinary_public_id_after'] = $imageToUploadArray['cloudinary_public_id'];
        }




        // Handle boolean field
        $data['is_special_case'] = isset($data['is_special_case']) ? 1 : 0;

        $data['doctor_name'] = Doctor::find($data['doctor_id'])->name;

        // Save to database
        return SpecialCase::create($data);
    }

    public function deleteCaseWithImages(SpecialCase $case): void
    {
        $case->delete();
        // // before image delete
        // if (file_exists('storage/' . $case->before_image))
        //     Storage::disk('public')->delete($case->before_image);
        // elseif (file_exists(public_path($case->before_image)))
        //     unlink(public_path($case->before_image));

        // // after image delete
        // if (file_exists('storage/' . $case->after_image))
        //     Storage::disk('public')->delete($case->after_image);
        // elseif (file_exists(public_path($case->after_image)))
        //     unlink(public_path($case->after_image));

        if ($case->cloudinary_public_id_before) {
            (new UploadApi())->destroy($case->cloudinary_public_id_before);
        }

        if ($case->cloudinary_public_id_after) {
            (new UploadApi())->destroy($case->cloudinary_public_id_after);
        }

    }
}
