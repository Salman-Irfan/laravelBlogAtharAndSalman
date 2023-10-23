<?php

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str; // for Slug

class ImageService
{
    public function upload(UploadedFile $file): ?string
    {
        if (!$file->isValid()) {
            return null;
        }
        // renaming the file
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        // removing spaces in name
        $imageName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '_blogThumbnail_' . time() . '.' . $extension;
        // storage location
        $imagePath = $file->storeAs('blog_images', $imageName, 'public');

        return $imagePath;
    }
}
