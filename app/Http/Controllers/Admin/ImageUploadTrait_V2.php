<?php

namespace App\Http\Controllers\Admin;

use Cloudinary\Api\Upload\UploadApi;

trait ImageUploadTrait_V2
{
    public function uploadImage($file_path, $object = null, $store_path, $file_name = 'image'  , $public_id = "cloudinary_public_id"): array
    {


        // $imagePath = $file_path[$file_name]->store($store_path);
        $uploaded = (new UploadApi())->upload($file_path, [
            'folder' => 'Dental-center/' . $store_path
        ]);


        $imageURL = $uploaded['secure_url']; // ✅ الرابط المباشر الآمن
        $cloudinary_public_id = $uploaded['public_id']; // ✅ معرف Cloudinary

        // حذف الصورة القديمة من Cloudinary إذا كانت موجودة
        if ($object != null && $object->cloudinary_public_id) {
            // Cloudinary::destroy($object->cloudinary_public_id);
            (new UploadApi())->destroy($object->$public_id);
        }

        // return $imagePath;
        return [
            'imageURL' => $imageURL,
            'cloudinary_public_id' => $cloudinary_public_id
        ];

    }
}
