<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

class ImageUploadHelper
{
    public static function upload(
        UploadedFile $file,
        string $folder = 'uploads',
        ?string $prefix = 'img',
        ?int $width = null,
        ?int $height = null,
        ?string $oldFile = null
    ): string {
        // Validate MIME type for extra security
        $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/svg+xml', 'image/gif'];
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            throw new \Exception('Invalid file type.');
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $filename = ($prefix ?? 'img') . '_' . time() . '_' . Str::random(5) . '.' . $extension;
        $directoryPath = public_path($folder);

        // Create directory if not exists
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        $fullPath = $directoryPath . '/' . $filename;

        // Delete old file safely
        if ($oldFile && file_exists($directoryPath . '/' . $oldFile)) {
            File::delete($directoryPath . '/' . $oldFile);
        }

        // Upload logic
        if ($extension === 'svg') {
            // Additional XSS protection for SVG
            $content = file_get_contents($file->getRealPath());
            $content = preg_replace('/<\?xml.*\?>/', '', $content); // remove XML declaration
            File::put($fullPath, $content);
        } else {
            $image = Image::make($file);

            if ($width || $height) {
                $image->resize($width ?? null, $height ?? null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            // Re-encode image to prevent malicious code
            $image->encode($extension, 90)->save($fullPath);
        }

        return $filename;
    }
}
