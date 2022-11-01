<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PhotoCollection;
use App\Models\News;
use Carbon\Carbon;

class PhotoController extends Controller
{
    public function index(Request $request)
    {

        $photo = News::with(['categories', 'tags', 'users', 'news_photo'])
            ->where('is_published', '=', '1')
            ->where('types', '=', 'photonews')
            ->where('published_at', '<=', now())
            ->latest('published_at');

        $limit = $request->get('limit', 10);
        if ($limit > 10) {
            $limit = 10;
        }

        return response()->json(new PhotoCollection($photo->paginate($limit)->withQueryString()));
    }
}
