<?php

namespace App\Http\Utils;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileFormatPath
{
    public $type;
    public $file;

    public function __construct($type, $file) {
        $this->type = $type;
        $this->file = $file;
    }

    protected function getPath()
    {
        return "/trstdly" . Carbon::now()->format('/Y/m/d/');
    }

    protected function getFileName()
    {
        $fullFileNameExtension = explode('.' . $this->file->getClientOriginalExtension(), $this->file->getClientOriginalName())[0];
        $fileName = strlen($fullFileNameExtension) > 150 ? substr($fullFileNameExtension, 150) : $fullFileNameExtension;
        // path_name_file = /news/2022/10/04/23423/zico-artonang.jpg
        return  substr(time(), 5) . '/' . Str::slug($fileName) . '.' . $this->file->getClientOriginalExtension();
    }

    public function getFullPathName(){
        return $this->getPath() . $this->getFileName();
    }

    public function storeFile()
    {
        try{
            $fileName = $this->getFileName();
            $folderPath = $this->getPath();
            Storage::putFileAs($folderPath, $this->file, $fileName);

            return $folderPath . $fileName;
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
