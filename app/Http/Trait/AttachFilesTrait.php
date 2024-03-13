<?php
namespace App\Http\Trait;
use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public function uploadFile($file,$path,$disk)
    {
        $file_name = $file->getClientOriginalName();
        $path = $file->storeAs($path, $file_name, $disk);
        return $path;

    }

    public function deleteFile( $filePath,$disk)
    {
        if (Storage::disk($disk)->exists($filePath)) {
            Storage::disk($disk)->delete($filePath);
        }

    }
}
