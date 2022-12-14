<?php

namespace App\Http\Utils;

use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

            return [
                'full_path_name' => $folderPath . $fileName,
                'directory' => $folderPath,
                'file_name' => $fileName,
            ];

        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function base64ToImage($files)
    {
        $fileName = "";
        $numItems = count($files);
        $i = 1;
        foreach ($files as $file) {
            $extension = explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1]; 
            $replace = substr($file, 0, strpos($file, ',') + 1);
            $image = str_replace($replace, '', $file);
            $image = str_replace(' ', '+', $image);
            $decoded_file = base64_decode($image); 
            $name = uniqid();
            $realName = $this->getPath() . substr(time(), 5) . '-' . $name . '.' . $extension;
            if ($i !== $numItems) {
                $fileName .= $realName . ",";
            } else {
                $fileName .= $realName;
            }
            try {
                Storage::put($realName, $decoded_file);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $i++;
        }
        return $fileName;
    }

}
