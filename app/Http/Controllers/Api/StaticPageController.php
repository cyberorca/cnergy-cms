<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StaticPageCollection;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function index(){
        $staticPage = StaticPage::latest()
            ->with(['users'])
            ->paginate(10);
        return response()->json(new StaticPageCollection($staticPage))
            ->setStatusCode(200);
    }
}
