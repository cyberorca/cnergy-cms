<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Carbon\Carbon;
use App\Models\Keywords;
use App\Models\Log;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\NewsServices;
use App\Http\Utils\FileFormatPath;
use App\Models\NewsPagination;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller implements NewsServices
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::with(['categories', 'tags'])->where('types', '=', 'news')->latest();
        $editors = User::join('roles', 'users.role_id', '=', 'roles.id')->where('roles.role', "Editor");
        $reporters = User::join('roles', 'users.role_id', '=', 'roles.id')->where('roles.role', "Reporter");
        $photographers = User::join('roles', 'users.role_id', '=', 'roles.id')->where('roles.role', "Photographer");

        if ($request->get('published')) {
            $published = $request->get('published');
            if ($published == 2) {
                $news->where('is_published', "0");
            } else {
                $news->where('is_published', "1");
            }
        }

        if ($request->get('inputTitle')) {
            $news->where('title', 'like', '%' . $request->inputTitle . '%');
        }

        if ($request->get('inputCategory')) {
            $news->whereHas('categories', function ($query) use ($request) {
                $query->where('category', 'like', "%{$request->get('inputCategory')}%");
            });
        }

        if ($request->get('headline')) {
            $headline = $request->get('headline');
            if ($headline == 2) {
                $news->where('is_headline', "0");
            } else {
                $news->where('is_headline', "1");
            }
        }

        if ($request->get('inputTag')) {
            $news->whereHas('tags', function ($query) use ($request) {
                $query->where('tags', 'like', "%{$request->get('inputTag')}%");
            });
        }

        if ($request->get('startDate') && $request->get('endDate')) {
            $startDate = Carbon::parse(($request->get('startDate')))
                ->toDateTimeString();

            $endDate = Carbon::parse($request->get('endDate'))
                ->toDateTimeString();
            $news->whereBetween('created_at', [
                $startDate, $endDate
            ]);
        }

        // if ($request->get('editor')) {
        //     $editor = $request->editor;
        //     $news->whereJsonContains('contributors', $editor);
        // }

        // if ($request->get('reporter')) {
        //     $reporter = $request->reporter;
        //     $news->whereJsonContains('reporters',$reporter);
        // }

        // if ($request->get('photographer')) {
        //     $photographer = $request->photographer;
        //     $news->whereJsonContains('photographers',$photographer);
        // }

        // return response()->json($news);

        $method = explode('/', URL::current());
        $newsRoleAccess = Menu::where('menu_name', '=', 'News')->with(['childMenusRoles', 'roles_user'])->get();
        $newsRole = [];
        foreach ($newsRoleAccess[1]->childMenusRoles as $r) {
            array_push($newsRole, $r->menu_name);
        }

        return view('news.index', [
            'type' => end($method),
            'news' => $news->orderBy("created_at", "DESC")->paginate(10)->withQueryString(),
            'editors' => $editors->get(),
            'reporters' => $reporters->get(),
            'photographers' => $photographers->get(),
            'newsRole' => $newsRole
            // 'categories' => Category::whereNull("parent_id"),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $method = explode('/', URL::current());
        $users = User::with(['roles'])->get();
        $categories = Category::whereNull('deleted_at')
        ->where('is_active','=','1')
        ->whereJsonContains('types','news')
        ->get();
//        $tags = Tag::all();
        //        return response()->json($users);


        return view('news.editable', [
            'method' => end($method),
            'categories' => $categories,
            'users' => $users,
//            'tags' => $tags,
            'contributors' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        $news_paginations = array();
        $keyArr[]= null;
        try {
            if ($data['keywords']!=null){
                foreach ($data['keywords'] as $t) {
                    if (is_numeric($t)){
                        $keyArr[] =  $t;
                    }
                    else{
                        $newKeyword = Keywords::create(['keywords'=>$t,
                            'created_at' => now(),
                            'created_by' => Auth::user()->uuid,
                        ]);
                        $keyArr[] = $newKeyword->id;
                    }
                }
            }

            for ($i = 0; $i < count($data['title']) - 1; $i++) {
                $news_paginations[$i] = [
                    'title' => $data['title'][$i + 1],
                    // 'synopsis' => $data['synopsis'][$i + 1],
                    'content' => $data['content'][$i + 1],
                    'slug' => Str::slug($data['title'][$i + 1]),
                    'order_by_no' => $i
                ];
            }

            if ($request->file('upload_image') && !$data['upload_image_selected']) {
                $file = $request->file('upload_image');
                $fileFormatPath = new FileFormatPath('news', $file);
                $data['image'] = $fileFormatPath->storeFile();
            }

            if ($data['upload_image_selected'] && !$request->file('upload_image')) {
                $data['image'] = explode(Storage::url(""), $data['upload_image_selected'])[1];
            }

            // return $news_paginations;
            $date = $data['date'];
            $time = $data['time'];
            $mergeDate = date('Y-m-d H:i:s', strtotime("$date $time"));

            $news = new News([
                'is_headline' => $request->has('isHeadline') == false ? '0' : '1',
                'is_home_headline' => $request->has('isHomeHeadline') == false ? '0' : '1',
                'is_category_headline' => $request->has('isCategoryHeadline') == false ? '0' : '1',
                'editor_pick' => $request->has('editorPick') == false ? '0' : '1',
                'is_curated' => $request->has('isCurated') == false ? '0' : '1',
                'is_adult_content' => $request->has('isAdultContent') == false ? '0' : '1',
                'is_verify_age' => $request->has('isVerifyAge') == false ? '0' : '1',
                'is_advertorial' => $request->has('isAdvertorial') == false ? '0' : '1',
                'is_seo' => $request->has('isSeo') == false ? '0' : '1',
                'is_disable_interactions' => $request->has('isDisableInteractions') == false ? '0' : '1',
                'is_branded_content' => $request->has('isBrandedContent') == false ? '0' : '1',
                'title' => $data['title'][0],
                'slug' => Str::slug($data['title'][0]),
                'content' => $data['content'][0],
                'synopsis' => $data['synopsis'],
                'description' => $data['description'],
                'types' => 'news',
               // 'keywords' => $data['keywords'],
                'photographers' => $request->has('photographers') == false ? null : json_encode($data['photographers']),
                'reporters' => $request->has('reporters') == false ? null : json_encode($data['reporters']),
                'contributors' => $request->has('contributors') == false ? null : json_encode($data['contributors']),
                'image' => $data['image'] ?? null,
                'is_published' => $data['isPublished'],
                'published_at' => $mergeDate,
                'published_by' => $request->has('isPublished') == false ? null : auth()->id(),
                'created_by' => auth()->id(),
                'category_id' => $data['category'],
                // 'video' => $data['video'] ?? null
            ]);
            if ($news->save()) {
                $log = new Log(
                    [
                        'news_id' => $news->id,
                        'updated_at' => now(),
                        'updated_by' => \auth()->id(),
                        'updated_content' => json_encode($news->getOriginal())
                    ]
                );
                $log->save();
            }

            if ($request->has('tags')){
                foreach ($data['tags'] as $t) {
                    if (!is_numeric($t)){
                        $checkId=Tag::where('tags',$t)->first('id');
                        $news->tags()->attach($checkId, ['created_by' => auth()->id()]);
                    }else{
                        $news->tags()->attach($t, ['created_by' => auth()->id()]);
                    }
                }
            }

            if ($keyArr!=null){
                foreach ($keyArr as $k) {
                    $news->keywords()->attach($k, ['created_by' => auth()->id()]);
                }
            }

            if (count($news_paginations)) {
                foreach ($news_paginations as $news_page) {
                    NewsPagination::create([
                        'title' => $news_page['title'],
                        'content' => $news_page['content'],
                        'order_by_no' => $news_page['order_by_no'],
                        'slug' => $news_page['slug'],
                        'news_id' => $news->id,
                    ]);
                }
            }

            return \redirect()->route('news.index')->with('status', 'Successfully Create News');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $method = explode('/', URL::current());
        $news = News::where('id', $id)->with(['users', 'news_paginations'])->first();
        $categories = Category::whereNull('deleted_at')
        ->where('is_active','=','1')
        ->whereJsonContains('types','news')->get();;
//        $tags = Tag::all();
        $keywords = Keywords::all();
        $contributors = $news->users;
        $users = User::with(['roles'])->get();
        return view('news.editable', [
            'method' => end($method),
            'categories' => $categories,
            'news' => $news,
//            'tags' => $tags,
            'keywords' => $keywords,
            'contributors' => $contributors,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->input();
        $news_paginations_old = array();
        // $news_paginations_new = array();

        $news_parent = [
            'title' => $data['title'][0],
            'content' => $data['content'][0]
        ];



        $i = 1;
        if (count($data['title']) > 1 && isset($data['title'][$id])) {
            foreach ($data['title'][$id] as $key => $value) {
                $news_paginations_old[$i] = [
                    'title' => $data['title'][$id][$key],
                    'content' => $data['content'][$id][$key],
                    'slug' => Str::slug($data['title'][$id][$key]),
                    'order_by_no' => $i,
                    'news_id' => $id,
                    'id' => $key
                ];
                $i++;
            }
        }

        if (count($data['title']) > 1) {
            foreach ($data['title'] as $key => $value) {
                if (in_array($key, [0, $id])) {
                    continue;
                }
                $news_paginations_old[$i] = [
                    'title' => $data['title'][$key],
                    'content' => $data['content'][$key],
                    'slug' => Str::slug($data['title'][$key]),
                    'order_by_no' => $i,
                    'news_id' => $id,
                    'id' => null
                ];
                $i++;
            }
        }


        $newsById = News::find($id);
        $date = $data['date'];
        $time = $data['time'];
        $margeDate = date('Y-m-d H:i:s', strtotime("$date $time"));
        $keyArr[] = null;
        try {
            if ($data['keywords']!=null){
                foreach ($data['keywords'] as $t) {
                    if (is_numeric($t)){
                        $keyArr[] =  $t;
                    }
                    else{
                        $newKeyword = Keywords::create(['keywords'=>$t,
                            'created_at' => now(),
                            'created_by' => Auth::user()->uuid,
                        ]);
                        $keyArr[] = $newKeyword->id;
                    }
                }
            }

            $input = [
                'is_headline' => $request->has('isHeadline') == false ? '0' : '1',
                'is_home_headline' => $request->has('isHomeHeadline') == false ? '0' : '1',
                'is_category_headline' => $request->has('isCategoryHeadline') == false ? '0' : '1',
                'editor_pick' => $request->has('editorPick') == false ? '0' : '1',
                'is_curated' => $request->has('isCurated') == false ? '0' : '1',
                'is_adult_content' => $request->has('isAdultContent') == false ? '0' : '1',
                'is_verify_age' => $request->has('isVerifyAge') == false ? '0' : '1',
                'is_advertorial' => $request->has('isAdvertorial') == false ? '0' : '1',
                'is_seo' => $request->has('isSeo') == false ? '0' : '1',
                'is_disable_interactions' => $request->has('isDisableInteractions') == false ? '0' : '1',
                'is_branded_content' => $request->has('isBrandedContent') == false ? '0' : '1',
                'title' => $news_parent['title'],
                //'slug' => Str::slug($news_parent['title']),
                'content' => $news_parent['content'],
                'synopsis' => $data['synopsis'],
                'description' => $data['description'],
                'types' => 'news',
                //'keywords' => $data['keywords'],
                'photographers' => $request->has('photographers') == false ? null : json_encode($data['photographers']),
                'reporters' => $request->has('reporters') == false ? null : json_encode($data['reporters']),
                'contributors' => $request->has('contributors') == false ? null : json_encode($data['contributors']),
                'is_published' => $data['isPublished'],
                'published_at' => $margeDate,
                'published_by' => $request->has('isPublished') == false ? null : auth()->id(),
                'updated_by' => auth()->id(),
                'category_id' => $data['category'],
                // 'video' => $data['video'] ?? null
            ];

            if ($request->file('upload_image') && !$data['upload_image_selected']) {
                $file = $request->file('upload_image');
                $fileFormatPath = new FileFormatPath('news', $file);
                $input['image'] = $fileFormatPath->storeFile();
            }

            if ($data['upload_image_selected'] && !$request->file('upload_image')) {
                $input['image'] = explode(Storage::url(""), $data['upload_image_selected'])[1];
            }
            $newsById->update($input);
            if ($request->has('tags')){
                $newsById::find($id)->tags()->detach();
                foreach ($data['tags'] as $t) {
                    if (!is_numeric($t)){
                        $checkId=Tag::where('tags',$t)->first('id');
                        $newsById->tags()->attach($checkId, ['created_by' => auth()->id()]);
                    }else{
                        $newsById->tags()->attach($t, ['created_by' => auth()->id()]);
                    }
                }
            }

            if ($keyArr!=null){
                $newsById::find($id)->keywords()->detach();
                foreach ($keyArr as $k) {
                    $newsById->keywords()->attach($k, ['created_by' => auth()->id()]);
                }
            }

            NewsPagination::upsert($news_paginations_old, ['id'], ['title', 'content', 'order_by_no']);

            $log = new Log(
                [
                    'news_id' => $id,
                    'updated_at' => now(),
                    'updated_by' => \auth()->id(),
                    'updated_content' => json_encode($newsById->getChanges())
                ]
            );
            $log->save();

            return \redirect()->route('news.index')->with('status', 'Successfully Update News');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            News::where('id', $id)->update([
                'deleted_by' => Auth::user()->uuid,
            ]);
            if (News::destroy($id)) {
                $log = new Log(
                    [
                        'news_id' => $id,
                        'updated_by' => \auth()->id(),
                        'updated_at' => now(),
                        'updated_content' => json_encode('DELETED')
                    ]
                );
                $log->save();
            }
            return Redirect::back()->with('status', 'Successfully Delete News');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    function deleteNewsPagination(Request $request)
    {
        try {
            $id = $request->id;
            NewsPagination::where('id', $id)->update([
                'deleted_by' => Auth::user()->uuid,
            ]);
            if (NewsPagination::destroy($id)) {
                return response()->json([
                    "status" => "success",
                    "message" => "Successfully Delete Page",
                ], 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 500);
        }
    }
    public function select(Request $request)
    {
        //$data = Tag::where('tags', 'LIKE',  '%' .request('q'). '%')->paginate(10)->withQueryString();
        //return response()->json($data);
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Tag::select("id", "tags")
                ->where('tags', 'LIKE', "%$search%")
                ->paginate(10)->withQueryString();
        } else {
            $data = Tag::paginate(10)->withQueryString();
        }
        return response()->json($data);
    }

    public function select2(Request $request)
    {
        //$data = Tag::where('tags', 'LIKE',  '%' .request('q'). '%')->paginate(10)->withQueryString();
        //return response()->json($data);
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Keywords::select("id", "keywords")
                ->where('keywords', 'LIKE', "%$search%")
                ->paginate(10)->withQueryString();
        } else {
            $data = Keywords::paginate(10)->withQueryString();
        }
        return response()->json($data);
    }
}
