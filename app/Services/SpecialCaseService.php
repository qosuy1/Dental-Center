<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\SpecialCase;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\uploadImageTrait;

class SpecialCaseService extends Controller
{
    use uploadImageTrait;

    public function createSpecialCase(array $data, $request = null): SpecialCase
    {
        // Handle file uploads
        if (isset($data['before_image'])) {
            // $data['before_image'] = $data['before_image']->store('cases/before_images', 'public');
            $data['before_image'] = $this->uploadImage($request, null, 'uploads/cases/before_images', 'before_image');
        }

        if (isset($data['after_image'])) {
            // $data['after_image'] = $data['after_image']->store('cases/after_images', 'public');
            $data['after_image'] = $this->uploadImage($request, null, 'uploads/cases/after_images', 'after_image');

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
        if (file_exists('storage/' . $case->before_image))
            Storage::disk('public')->delete($case->before_image);
        elseif (file_exists(public_path($case->before_image)))
            unlink(public_path($case->before_image));


        if (file_exists('storage/' . $case->after_image))
            Storage::disk('public')->delete($case->after_image);
        elseif (file_exists(public_path($case->after_image)))
            unlink(public_path($case->after_image));


    }
}
