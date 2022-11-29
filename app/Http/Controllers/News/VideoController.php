<?php

namespace App\Http\Controllers\News;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\News;
use App\Models\Tag;
use App\Models\Keywords;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Utils\FileFormatPath;
use App\Models\VideoNews;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::with(['categories', 'tags'])->where('types', '=', 'video')->orderBy("created_at", "DESC");
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

        if ($request->get('editor')) {
            $editor = $request->editor;
            $news->where('updated_by', $editor);
        }

        if ($request->get('reporter')) {
            $reporter = $request->reporter;
            $news->where('created_by', $reporter);
        }

        // return response()->json($news);
        $method = explode('/', URL::current());
        $videoRole= Menu::where('menu_name','=','Video')->with(['childMenusRoles','roles_user'])->first();
        $newsRole=[];
        foreach ($videoRole->childMenusRoles as $r){
            array_push($newsRole,$r->menu_name);
        }
        return view('news.index', [
            'type' => end($method),
            'news' => $news->paginate(10)->withQueryString(),
            'editors' => $editors->get(),
            'reporters' => $reporters->get(),
            'photographers' => $photographers->get(),
            'newsRole'=>$newsRole
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
        $users = User::all();
        $categories =Category::whereNull('deleted_at')
        ->where('is_active','=','1')
        ->whereJsonContains('types','video')->get();
//        $tags = Tag::all();
        $types = 'video';
        $date = date('Y-m-d');
        $time = time();
        return view('news.video.editable', [
            'method' => end($method),
            'categories' => $categories,
            'types' => $types,
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
        $date = $data['date'];
        $time = $data['time']; 
        $mergeDate = date('Y-m-d H:i:s', strtotime("$date $time"));
        // return response()->json($request->all());
        try {
            if ($request->file('upload_image') && !$data['upload_image_selected']) {
                $file = $request->file('upload_image');
                $fileFormatPath = new FileFormatPath('video/image', $file);
                $data['image'] = $fileFormatPath->storeFile();
            }

            if ($data['upload_image_selected'] && !$request->file('upload_image')) {
                $data['image'] = explode(Storage::url(""), $data['upload_image_selected'])[1];
            }

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
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
                'synopsis' => $data['synopsis'],
                'description' => $data['description'],
                'types' => 'video',
                //'keywords' => $data['keywords'],
                'reporters' => $request->has('reporters') == false ? null : json_encode($data['reporters']),
                'photographers' => $request->has('photographers') == false ? null : json_encode($data['photographers']),
                'contributors' => $request->has('contributors') == false ? null : json_encode($data['contributors']),
                'image' => $data['image'] ?? null,
                'is_published' => $data['isPublished'],
                'published_at' => $mergeDate,
                'published_by' => $request->has('isPublished') == false ? null : auth()->id(),
                'created_by' => auth()->id(),
                'category_id' => $data['category'],
                // 'video' => $data['video']
            ]);

            // return $news;

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
            VideoNews::create([
                'title' => $data['title'],
                'video' => $data['video'],
                'news_id' => $news->id,
                'order_by_no' => 1,
            ]);
            foreach ($data['tags'] as $t) {
                $news->tags()->attach($t, ['created_by' => auth()->id()]);
            }
            foreach ($keyArr as $k) {
                $news->keywords()->attach($k, ['created_by' => auth()->id()]);
            }

            return \redirect()->route('video.index')->with('status', 'Successfully Create Video News');
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
        $news = News::where('id', $id)->with('news_videos:id,video,news_id')->first();
        $categories = Category::whereNull('deleted_at')
        ->where('is_active','=','1')
        ->whereJsonContains('types','video')->get();
//        $tags = Tag::all();
        $keywords = Keywords::all();
        $types = 'video';
        $contributors = $news->users;
        $users = User::with(['roles'])->get();
        return view('news.video.editable', [
            'method' => end($method),
            'categories' => $categories,
            'types' => $types,
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
        $newsById = News::find($id);
        $date = $data['date'];
        $time = $data['time'];
        $margeDate = date('Y-m-d H:i:s', strtotime("$date $time"));
        try {
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
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
                'synopsis' => $data['synopsis'],
                'image' => $data['image'] ?? $newsById->image,
                'description' => $data['description'],
                'types' => 'video',
                //'keywords' => $data['keywords'],
                'reporters' => $request->has('reporters') == false ? null : json_encode($data['reporters']),
                'photographers' => $request->has('photographers') == false ? null : json_encode($data['photographers']),
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
                $fileFormatPath = new FileFormatPath('video/image', $file);
                $input['image'] = $fileFormatPath->storeFile();
            }

            if ($data['upload_image_selected'] && !$request->file('upload_image')) {
                $input['image'] = explode(Storage::url(""), $data['upload_image_selected'])[1];
            }

            $newsById->update($input);
            VideoNews::find($data['video_id'])->update([
                'video' => $data['video'],
            ]);
            $newsById::find($id)->tags()->detach();
            foreach ($data['tags'] as $t) {
                $newsById->tags()->attach($t, ['created_by' => auth()->id()]);
            }
            $newsById::find($id)->keywords()->detach();
            foreach ($keyArr as $k) {
                $newsById->keywords()->attach($k, ['created_by' => auth()->id()]);
            }

            $log = new Log(
                [
                    'news_id' => $id,
                    'updated_at' => now(),
                    'updated_by' => \auth()->id(),
                    'updated_content' => json_encode($newsById->getChanges())
                ]
            );
            $log->save();

            return \redirect()->route('video.index')->with('status', 'Successfully Update Video News');
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
            return Redirect::back()->with('status', 'Successfully Delete Video News');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
