<?php

namespace App\Http\Utils;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class FileFormatPath
{
    public $type;
    public $file;

    public function __construct($type = "trstdly", $file = null)
    {
        $this->type = $type;
        $this->file = $file;
    }

    public function getPath()
    {
        return "/" . $this->type . Carbon::now()->format('/Y/m/d/');
    }

    public function getFileName()
    {
        $fullFileNameExtension = explode('.' . $this->file->getClientOriginalExtension(), $this->file->getClientOriginalName())[0];
        $fileName = $fullFileNameExtension;
        // path_name_file = /news/2022/10/04/23423/zico-artonang.jpg
        // path_name_file = /news/2022/10/04/23423-zico-artonang.jpg
        return  substr(time(), 5) . '-' . Str::slug($fileName) . '.' . $this->file->getClientOriginalExtension();
    }

    public function getFullPathName()
    {
        return $this->getPath() . $this->getFileName();
    }

    public function storeFile()
    {
        try {
            $fileName = $this->getFileName();
            $folderPath = $this->getPath();
            Storage::putFileAs($folderPath, $this->file, $fileName);

            return $folderPath . $fileName;
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function storeFileTemp()
    {
        try {
            $fileName = $this->getFileName();
            $folderPath = $this->getPath();
            Storage::putFileAs($folderPath, $this->file, $fileName);
            $this->resizeImage($folderPath, $fileName);

            return [
                'full_path_name' => $folderPath . $fileName,
                'directory' => $folderPath,
                'file_name' => $fileName,
            ];
        } catch (\Throwable $e) {
            die($e);
            return $e;
        }
    }

    public function resizeImage($folderPath, $fileName)
    {
        try {
            $image_driver = new ImageManager();
            $image = $image_driver->make($this->file)->orientate();
            $image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $nameOfFile = implode("-200x" . $image->getHeight(), explode("." . $this->file->getClientOriginalExtension(), $fileName, 2));
            Storage::put($folderPath . $nameOfFile . ".png", $image->encode($this->file->getClientOriginalExtension()));
        } catch (\Throwable $e) {
            die($e);
            return $e;
        }
    }
}
