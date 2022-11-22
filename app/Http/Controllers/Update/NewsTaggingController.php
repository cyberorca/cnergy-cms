<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class NewsTaggingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::with(['categories', 'tags'])->latest();
        $reporters = User::join('roles', 'users.role_id', '=', 'roles.id')->where('roles.role', "Reporter");
        $editors = User::join('roles', 'users.role_id', '=', 'roles.id')->where('roles.role', "Editor");
        if ($request->get('reporter')) {
            $reporter = $request->reporter;
            $news->whereJsonContains('reporters', $reporter);
        }
        if ($request->get('editor')) {
            $editor = $request->editor;
            $news->whereJsonContains('contributors', $editor);
        }
        if ($request->get('inputTitle')) {
            $news->where('title', 'like', '%' . $request->inputTitle . '%');
        }
        if ($request->get('inputCategory')) {
            $news->whereHas('categories', function ($query) use ($request) {
                $query->where('category', 'like', "%{$request->get('inputCategory')}%");
            });
        }
        if ($request->get('inputTag')) {
            $news->whereHas('tags', function ($query) use ($request) {
                $query->where('tags', 'like', "%{$request->get('inputTag')}%");
            });
        }
        if ($request->get('newsTypes')) {
            $news->where('types', '=', $request->newsTypes);
        }
        if ($request->get('published')) {
            $published = $request->get('published');
            if ($published == 0) {
                $news->where('is_published', "0");
            } else {
                $news->where('is_published', "1");
            }
        }

        if ($request->get('startDate') && $request->get('endDate')) {
            $startDate = Carbon::parse(($request->get('startDate')))
                ->toDateTimeString();

            $endDate = Carbon::parse($request->get('endDate'))
                ->toDateTimeString();
            $news->whereBetween('published_at', [
                $startDate, $endDate
            ]);
        }

        return view('news-tagging.index', [
            'newsTypes' => ['video', 'news', 'photonews'],
            'news' => $news->paginate(10)->withQueryString(),
            'reporters' => $reporters->get(),
            'editors' => $editors->get()
        ]);
    }

    public function updateTagging(Request $request)
    {
        if ($request->ajax()) {
            $tags = $request->tags;
            $newsById = News::find($request->id);
            $tagsFilled = [];

            if ($tags != null) {
                $newsById->tags()->detach();
                //data temp tags
                $tagsFilled = $this->getTagsFilled($tags);

//               return response()->json($tagsFilled);
                foreach ($tagsFilled as $id) {
                    $newsById->tags()->attach($id, ['created_by' => auth()->id(), 'created_at' => now()]);
                }

            } else {
                $newsById->tags()->detach();
            }

            return response()->json(['news' => $newsById, 'tagFilled' => $tagsFilled]);
        }

    }

    public function getTagging(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $tags = Tag::orderby('tags', 'asc')
                ->select('id', 'tags')
                ->limit(5)
                ->get();
        } else {
            $tags = Tag::orderby('tags', 'asc')
                ->select('id', 'tags')
                ->where('tags', 'like', '%' . $search . '%')
                ->limit(5)
                ->get();
        }

        $response = array();
        foreach ($tags as $tag) {
            $response[] = array(
                "id" => $tag->id,
                "text" => $tag->tags
            );
        }

        return response()->json($response);
    }

    public function multiTagging(Request $request)
    {
        //data mass tags
        $massTag = $request->get('massTag');

        //data temp tags
        $tagsFilled = $this->getTagsFilled($massTag);

        //data id news only checked
        $checkedTag = $request->get('checkedTag');

        try {
            if ($checkedTag != null) {
                foreach ($checkedTag as $id) {
                    $newsById = News::find($id);
                    foreach ($tagsFilled as $m) {
                        if (!$newsById->tags->contains($m)) {
                            $newsById->tags()->attach($m, ['created_by' => auth()->id(), 'created_at' => now()]);
                        }
                    }
                }
                return \redirect()->route('news-tagging.index')->with('status', 'Successfully Update News Tags');
            } else {
                return Redirect::back()->withErrors(['Error' => 'Please Checked First']);
            }

        } catch (\Exception $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }

    }

    public function insertTagging(Request $request)
    {
        if ($request->ajax()) {
            $tags = $request->tags;

            //data temp tags
            $tagsFilled = $this->getTagsFilled($tags);

            return response()->json(['tagFilled' => $tagsFilled]);
        }
    }

    /**
     * @param mixed $tags
     * @return array
     */
    public function getTagsFilled(mixed $tags): array
    {
        $tagsFilled = [];

        //filter tags convert to new array
        foreach ($tags as $t) {
            $isTagReady = Tag::where('tags', '=', $t)->exists();
            if ($isTagReady) {
                $getId = Tag::where('tags', '=', $t)->first()->id;
                array_push($tagsFilled, $getId);
            } else {
                if (!is_numeric($t)) {
                    $newTagID = Tag::insertGetId([
                        'tags' => ucwords($t),
                        'slug' => Str::slug($t),
                        'created_at' => now(),
                        'created_by' => Auth::user()->uuid,
                    ]);
                    array_push($tagsFilled, $newTagID);
                }
            }
        }
        return $tagsFilled;
    }

}
