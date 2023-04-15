<?php

namespace App\Service\Contracts;

interface FileServiceContract
{
    /**
     * @param string $imgUri
     * @return void
     */
    public function uploadImgFromUri(string $imgUri): void;
}
