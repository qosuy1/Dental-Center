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

        // $imagePath = $request[$file_name]->store($store_path);
        $image = $request->file($file_name);
        $newFileName = time() . random_int(1, 9999);
        $image->move(public_path($store_path), $newFileName);

        //delete old image
        if (isset($object->$file_name) && $object->$file_name != $newFileName && file_exists(public_path($object->$file_name)))
            // Storage::disk('public')->delete($object->$file_name);
            unlink(public_path($object->$file_name));

        // return $imagePath;
        return $store_path . "/" . $newFileName;

    }
}
