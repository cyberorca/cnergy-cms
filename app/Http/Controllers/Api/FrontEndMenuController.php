<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FrontEndMenu;
use Illuminate\Http\Request;

class FrontEndMenuController extends Controller
{
    public function index()
    {
        $fe_menus = FrontEndMenu::orderBy('order','asc')
            ->whereNull('parent_id')
            ->with(["childMenus" => function($query){
                $query->orderBy('order','asc');
            }])->get();
        $data = $this->convertDataToResponse($fe_menus);
        return response()->json($data);
    }

    private function convertDataToResponse($dataRaw){
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
    }
}
