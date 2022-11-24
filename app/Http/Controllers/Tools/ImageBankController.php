<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageBankRequest;
use App\Http\Utils\FileFormatPath;
use App\Models\ImageBank;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ImageBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image_bank = ImageBank::all();
        return view("tools.image-bank.index", compact("image_bank"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $method = explode('/', URL::current());
        return view("tools.image-bank.editable", ['method' => end($method)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageBankRequest $request)
    {
        try {
            $input = $request->validated();
            $data = [
                "title" => $input["title"],
                "photographer" => $input["photographer"],
                "copyright" => $input["copyright"],
                "caption" => $input["caption"],
                "keywords" => $input["keywords"],
                "image_alt" => $input["image_alt"],
                "description" => $input["description"],
                "created_by" => Auth::user()->uuid
            ];
            if ($request->hasFile('image_input')) {
                $file = $request->file('image_input');
                $fileFormatPath = new FileFormatPath('image-bank', $file);
                $data['slug'] = $fileFormatPath->storeFile();
            }
            ImageBank::create($data);
            return redirect()->route('image-bank.index')->with('status', 'Successfully Add Image');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function upload_image(Request $request)
    {
        try {
            $input = $request->all();
            $data = [
                "title" => $input["title_image"],
                "photographer" => $input["photographer"],
                "copyright" => $input["copyright"],
                "caption" => $input["caption"],
                "keywords" => $input["keywords"],
                "description" => $input["description_image"],
                "image_alt" => $input["image_alt"],
                "created_by" => Auth::user()->uuid
            ];
            if ($request->hasFile('image_input')) {
                $file = $request->file('image_input');
                $fileFormatPath = new FileFormatPath('image-bank', $file);
                $data['slug'] = $fileFormatPath->storeFile();
            }
            ImageBank::create($data);
            return response()->json([
                'message' => 'Successfully add image',
                'data' => [
                    'image_slug' => $data['slug']
                ]
            ], 200);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 500);
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
        $imageBankById = ImageBank::with('createdBy')->find($id)->first();
        return view('tools.image-bank.editable',
            ['method' => end($method),
                'imageBank'=>$imageBankById
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageBankRequest $request, $id)
    {
        try {
            $input = $request->validated();
            $data = [
                "title" => $input["title"],
                "photographer" => $input["photographer"],
                "copyright" => $input["copyright"],
                "caption" => $input["caption"],
                "keywords" => $input["keywords"],
                "image_alt" => $input["image_alt"],
                "description" => $input["description"],
                "updated_by" => Auth::user()->uuid
            ];
            $imageBankById = ImageBank::find($id)->first();
            $imageBankById->update($data);
            return redirect()->route('image-bank.index')->with('status', 'Successfully Edit Meta Image');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
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
        try {
            $image = ImageBank::find($id);
            $image->deleted_by = Auth::user()->uuid;
            // Storage::delete('public/image_bank/' . $image->slug);
            $image->delete();
            return redirect()->back()->with('status', 'Successfully Delete Image');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function apiList(Request $request)
    {
        $image_bank = ImageBank::all();
        if ($request->get('title')) {
            // $image_bank->where('title', 'like', '%' . $request->title . '%');
            $image_bank = ImageBank::where('title', 'like', '%' . $request->title . '%')->get();
            return response()->json($image_bank);
        }
        return response()->json($image_bank);
    }

    public function displayImage($filename)
    {
        $path = storage_path('app/public/' . $filename);
        // return $filename;
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        // $response->header("Content-Type", $type);
        return $response;
    }
}
