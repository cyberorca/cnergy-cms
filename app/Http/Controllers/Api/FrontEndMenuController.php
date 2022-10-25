<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FrontEndMenu;
use App\Http\Resources\FrontEndMenuCollection;
use Illuminate\Http\Request;

class FrontEndMenuController extends Controller
{
    public function index(Request $request)
    {
        $fe_menus = FrontEndMenu::latest()
            ->whereNull('parent_id')
            ->with(["childMenus" => function($query){
                $query->orderBy('order','asc');
            }])
            ->where('slug', 'like', '%' . $request->get('slug', '') . '%')
            ->paginate($request->get('limit', 20))->withQueryString();

            return response()->json(new FrontEndMenuCollection($fe_menus));
    }

    /*private function convertDataToResponse($dataRaw){ 
        return $dataRaw->transform(function ($item, $key) {
            return [
                'id' => $item->id,
                'parent' => $item->parent_id,
                'title'=>$item->title,
                'url'=>'/'.$item->slug,
                'type'=>'link',
                'target'=>'self',
                'order'=>$item->order,
                'position'=>json_decode($item->position),
                'children'=>$this->convertDataToResponse($item->childMenus)
            ];
        });
    }*/
}
