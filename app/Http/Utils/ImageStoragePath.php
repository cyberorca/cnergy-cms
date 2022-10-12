<?php

namespace App\Http\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ImageStoragePath
{
    public static function getStoragePath($filename){
        $path = storage_path('app/public/' . $filename);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;

    }
}
