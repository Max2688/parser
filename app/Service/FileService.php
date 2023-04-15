<?php

namespace  App\Service;

use App\Service\Contracts\FileServiceContract;
use Intervention\Image\Facades\Image as ImageLib;
use function storage_path;

class FileService implements FileServiceContract
{
    /**
     * @inheritDoc
     */
    public function uploadImgFromUri(string $imgUri): void
    {
        $filename = basename($imgUri);
        ImageLib::make($imgUri)
            ->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(storage_path('app/public') . DIRECTORY_SEPARATOR . $filename);

    }

}
