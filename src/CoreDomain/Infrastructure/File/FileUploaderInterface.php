<?php

namespace CoreDomain\Infrastructure\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploaderInterface
{
    public function upload(UploadedFile $file, $context);
    public function uploadFromURL($url, $context);
}
