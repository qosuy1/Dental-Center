<?php

namespace App\Http\Controllers\Admin;

use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

trait uploadImageTrait
{
    // to store the image in the storage
    public function uploadImage($request, $object = null, $store_path, $file_name = 'image'): array
    {
        if (!$request->hasFile($file_name)) {
            return $object->$file_name ?? null;
        }

        // $imagePath = $request[$file_name]->store($store_path);
        $uploaded = (new UploadApi())->upload($request->file($file_name)->getRealPath(), [
            'folder' => 'Dental-center/' . $store_path
        ]);

        // dd('hello from upload');

        $imageURL = $uploaded['secure_url']; // ✅ الرابط المباشر الآمن
        $cloudinary_public_id = $uploaded['public_id']; // ✅ معرف Cloudinary

        // حذف الصورة القديمة من Cloudinary إذا كانت موجودة
        if ( $object != null && $object->cloudinary_public_id) {
            // Cloudinary::destroy($object->cloudinary_public_id);
            (new UploadApi())->destroy($object->cloudinary_public_id);
        }

        // return $imagePath;
        return [
            'imageURL' => $imageURL,
            'cloudinary_public_id' => $cloudinary_public_id
        ];

    }
}
