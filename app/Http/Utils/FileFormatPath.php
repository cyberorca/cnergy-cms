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
        return "/" . $this->type . Carbon::now()->format('/Y/m/d/');
    }

    protected function getFileName()
    {
        // path_name_file = /news/2022/10/04/23423-zico-artonang.jpg
        return  Str::slug(substr(now(), 5) . '-' . explode('.' . $this->file->getClientOriginalExtension(), $this->file->getClientOriginalName())[0]) . '.' . $this->file->getClientOriginalExtension();
    }

    public function getFullPathName(){
        return $this->getPath() . $this->getFileName();
    }

    public function storeFile()
    {
        try{
            Storage::putFileAs($this->getPath(), $this->file, $this->getFileName());

            return $this->getFullPathName();
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
