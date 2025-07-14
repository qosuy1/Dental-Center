<?php
namespace App\Jobs;

use App\Http\Controllers\Admin\ImageUploadTrait_V2;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class ProcessImageUploade implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ImageUploadTrait_V2;

    public $model;
    public $filePath;
    public $store_path;
    public $image;
    public $public_id;

    public function __construct(Model $model, string $filePath, string $store_path, string $image = "image", string $public_id = 'cloudinary_public_id')
    {
        $this->model = $model;
        $this->filePath = $filePath;
        $this->store_path = $store_path;
        $this->image = $image;
        $this->public_id = $public_id;

    }

    public function handle(): void
    {

        // $uploaded = (new UploadApi())->upload($this->filePath, [
        //     'folder' => 'Dental-center/' . $this->store_path
        // ]);

        // Log::info($this->filePath);

        $toUploadImageArray = $this->uploadImage($this->filePath, $this->model, $this->store_path, $this->image, $this->public_id);

        $this->model->update([
            $this->image => $toUploadImageArray['imageURL'],
            $this->public_id => $toUploadImageArray['cloudinary_public_id'],
        ]);

        // بعد الرفع، حذف الملف المؤقت
        if (file_exists($this->filePath)) {
            unlink($this->filePath);
        }

    }
}
