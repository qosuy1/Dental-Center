<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;

trait uploadImageTrait
{
    // to store the image in the storage
    public function uploadImage($request, $object = null, $store_path, $file_name = 'image')
    {
        if (!$request->hasFile($file_name)) {
            return $object->$file_name ?? null;
        }

        $imagePath = $request[$file_name]->store($store_path);

        //delete old image
        if (isset($object->$file_name) && $object->$file_name != $imagePath)
            Storage::disk('public')->delete($object->$file_name);

        return $imagePath;
    }
}
