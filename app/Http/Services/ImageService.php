<?php

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageService
{
    public function upload(UploadedFile $file): ?string
    {
        if (!$file->isValid()) {
            return null;
        }

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $imageName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '_blogThumbnail_' . time() . '.' . $extension;
        $imagePath = $file->storeAs('blog_images', $imageName, 'public');

        return $imagePath;
    }
}
