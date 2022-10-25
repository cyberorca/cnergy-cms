<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StaticPageCollection;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function index(){
        $staticPage = StaticPage::latest();

        if($request->get("slug")){
            $staticPage->where('slug', '=', $request->get('slug', ''));
        }

        $limit = $request->get('limit', 20);
        if($limit > 20){
            $limit = 20;
        }
        
        return response()->json(new StaticPageCollection($staticPage->paginate($limit)->withQueryString()))->setStatusCode(200);
        
        // $staticPage = StaticPage::latest()
        //     ->with(['users'])
        //     ->paginate(10);
        // return response()->json(new StaticPageCollection($staticPage))
        //     ->setStatusCode(200);
    }
}
