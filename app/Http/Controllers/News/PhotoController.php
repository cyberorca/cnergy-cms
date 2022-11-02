<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Models\News;
use App\Models\User;
use App\Models\Log;
use App\Models\Tag;
use App\Models\Category;
use App\Models\PhotoNews;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Utils\FileFormatPath;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::with(['categories', 'tags'])->where('types','=','photonews')->latest();
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
        return view('news.index', [
            'type' => end($method),
            'news' => $news->orderBy("id", "DESC")->paginate(10)->withQueryString(),
            'editors' => $editors->get(),
            'reporters' => $reporters->get(),
            'photographers' => $photographers->get()
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
        $categories = Category::all();
        $tags = Tag::all();
        $types = 'photonews';
        $date = date('Y-m-d');
        $time = time();
        return view('news.photonews.editable', [
            'method' => end($method),
            'categories' => $categories,
            'types' => $types,
            'users' => $users,
            'tags' => $tags,
            'contributors' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        $news_images = array();
        $date = $data['date'];
        $time = $data['time'];
        $mergeDate = date('Y-m-d H:i:s', strtotime("$date $time"));
        //return response()->json($request->all());
        try {
            //$i = 2;
            for ($i = 0; $i < count($data['title_photonews']) - 1; $i++) {
                $news_images[$i] = [
                    'title' => $data['title_photonews'][$i + 1],
                    'caption' => $data['caption_photonews'][$i + 1],
                    'url' => $data['url_photonews'][$i + 1],
                    //'image' => $data['url_photonews'][$i + 1],
                    'copyright' => $data['copyright_photonews'][$i + 1],
                    'description' => $data['description_photonews'][$i + 1],
                    'keywords' => $data['keywords_photonews'][$i + 1],
                    'order_by_no' => $i
                ];
                //$i++;
            }
            /*if ($request->file('upload_image') && !$data['upload_image_selected']) {
                $file = $request->file('upload_image');
                $fileFormatPath = new FileFormatPath('photo/image', $file);
                $data['image'] = $fileFormatPath->storeFile();
            }

            if ($data['upload_image_selected'] && !$request->file('upload_image')) {
                $data['image'] = explode(Storage::url(""), $data['upload_image_selected']);
            }*/
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
                'types' => 'photonews',
                'keywords' => $data['keywords'],
                'photographers' => $request->has('photographers') == false ? null : json_encode($data['photographers']),
                'reporters' => $request->has('reporters') == false ? null : json_encode($data['reporters']),
                'contributors' => $request->has('contributors') == false ? null : json_encode($data['contributors']),
                'image' => $data['image'] ?? null,
                'is_published' => $data['isPublished'],
                'published_at' => $mergeDate,
                'published_by' => $request->has('isPublished') == false ? null : auth()->id(),
                'created_by' => auth()->id(),
                'category_id' => $data['category']
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
            foreach ($data['tags'] as $t) {
                $news->tags()->attach($t);
            }

            if (count($news_images)) {
                foreach ($news_images as $photonews) {
                    PhotoNews::create([
                        'title' => $photonews['title'],
                        'image' => $photonews['caption'],
                        'url' => $photonews['url'],
                        'copyright' => $photonews['copyright'],
                        'description' => $photonews['description'],
                        'keywords' => $photonews['keywords'],
                        'order_by_no' => $photonews['order_by_no'],
                        'news_id' => $news->id,
                        'created_by' => auth()->id(),
                        'is_active' => "1"
                    ]);
                }
            }

            return \redirect()->route('photo.index')->with('status', 'Successfully Create PhotoNews');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $method = explode('/', URL::current());
        $news = News::where('id', $id)->with('users')->first();
        $categories = Category::all();
        $tags = Tag::all();
        $types = 'photonews';
        $contributors = $news->users;
        $users = User::with(['roles'])->get();
        return view('news.photonews.editable', [
            'method' => end($method),
            'categories' => $categories,
            'types' => $types,
            'news' => $news,
            'tags' => $tags,
            'contributors' => $contributors,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
            if ($request->file('upload_image') && !$data['upload_image_selected']) {
                $file = $request->file('upload_image');
                $fileFormatPath = new FileFormatPath('photonews/image', $file);
                $input['image'] = $fileFormatPath->storeFile();
            }

            if ($data['upload_image_selected'] && !$request->file('upload_image')) {
                $input['image'] = explode(Storage::url(""), $data['upload_image_selected'])[1];
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
                'image' => $data['image'] ?? null,
                'description' => $data['description'],
                'types' => 'photonews',
                'keywords' => $data['keywords'],
                'photographers' => $request->has('photographers') == false ? null : json_encode($data['photographers']),
                'reporters' => $request->has('reporters') == false ? null : json_encode($data['reporters']),
                'contributors' => $request->has('contributors') == false ? null : json_encode($data['contributors']),
                'is_published' => $data['isPublished'],
                'published_at' => $margeDate,
                'published_by' => $request->has('isPublished') == false ? null : auth()->id(),
                'updated_by' => auth()->id(),
                'category_id' => $data['category']
            ];

            $newsById->update($input);
            $newsById::find($id)->tags()->detach();
            foreach ($data['tags'] as $t) {
                $newsById->tags()->attach($t);
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

            return \redirect()->route('photo.index')->with('status', 'Successfully Update PhotoNews');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
