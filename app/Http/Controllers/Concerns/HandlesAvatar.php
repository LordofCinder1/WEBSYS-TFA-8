<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

trait HandlesAvatar
{
    /** Crop the upload to a 300x300 JPEG and return its path on the public disk. */
    private function processAvatar(UploadedFile $file, string $directory): string
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file->getRealPath());
        $image->cover(300, 300);

        $filename = $directory . '/' . Str::uuid() . '.jpg';
        Storage::disk('public')->put($filename, (string) $image->toJpeg(85));

        return $filename;
    }

    private function deleteAvatar(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
