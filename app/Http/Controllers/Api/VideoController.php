<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoCollection;
use App\Models\News;

class VideoController extends Controller
{
    public function index(){
        /*order by published_at desc
        //by is_published
        //limit 10
        //date <= now
        //filter by id category
        //filter by headline 1|0
        */

        $video = News::with(['categories', 'tags','users'])
            ->where('types','=','video')
            ->where('is_published','=','1')
            ->where('published_at','<=',now())
            ->latest('published_at');

        return response()->json(new VideoCollection($video->paginate(10)));
    }

}
