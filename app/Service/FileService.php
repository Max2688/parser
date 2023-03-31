<?php

namespace  App\Service;

use Intervention\Image\Facades\Image as ImageLib;
use function storage_path;

class FileService
{
    public function uploadImgFromUri(string $imgUri)
    {
        $filename = basename($imgUri);
        ImageLib::make($imgUri)
            ->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(storage_path('app/public') . DIRECTORY_SEPARATOR . $filename);

    }

}
