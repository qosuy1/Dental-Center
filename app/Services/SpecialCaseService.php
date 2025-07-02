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

    public function createSpecialCase(array $data): SpecialCase
    {
        // Handle file uploads
        if (isset($data['before_image'])) {
            $data['before_image'] = $data['before_image']->store('cases/before_images', 'public');
        }

        if (isset($data['after_image'])) {
            $data['after_image'] = $data['after_image']->store('cases/after_images', 'public');
        }

        // Handle boolean field
        $data['is_special_case'] = isset($data['is_special_case']) ? 1 : 0 ;

        $data['doctor_name'] = Doctor::find($data['doctor_id'])->name;

        // Save to database
        return SpecialCase::create($data);
    }

    public function deleteCaseWithImages(SpecialCase $case): void
    {
        $case->delete();
        if ($case->before_image) {
            Storage::disk('public')->delete($case->before_image);
        }

        if ($case->after_image) {
            Storage::disk('public')->delete($case->after_image);
        }

    }
}
