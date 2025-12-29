<?php

namespace App;

use Illuminate\Support\Str;

trait imageUploadTrait
{
    public function uploadImage($image, $folder, $oldImage = null)
    {
        $filePath = Str::random(20) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path("uploads/$folder"), $filePath);

        if ($oldImage && file_exists(public_path("/uploads/$folder/$oldImage"))) {
            unlink(public_path("/uploads/$folder/$oldImage"));
        }
        return $filePath;
    }
}
