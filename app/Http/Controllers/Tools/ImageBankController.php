<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageBankRequest;
use App\Http\Utils\FileFormatPath;
use App\Http\Utils\ImageMetadata;
use App\Models\ImageBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ImageBankController extends Controller
{
    use ImageMetadata;

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
     * @param \Illuminate\Http\Request $request
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


            $arrFileName = array();
            $folderPath = 'tmp/' . $request->unique_id . '/';
            $files = Storage::allFiles($folderPath);
            $realPath = new FileFormatPath();
            $pattern = "/-200xauto.jpg/";
            foreach ($files as $path) {
                $file = pathinfo($path);
                $fileName = $realPath->getPath() . '/' . $file['basename'];
                Storage::move($file['dirname'] . '/' . $file['basename'], $fileName);
                if (!preg_match($pattern, $fileName)) {
                    array_push($arrFileName, $fileName);
                }
            }
            Storage::deleteDirectory($folderPath);

            foreach ($arrFileName as $name) {
                $data['slug'] = $name;
                $imageBank = ImageBank::create($data);
                $isFormatSupport = $this->isFormat($imageBank->slug);
                if ($isFormatSupport === true) {
                    $this->setMetaData(
                        $imageBank->slug,
                        $input["copyright"],
                        $input["description"],
                        $input["photographer"],
                        $input["title"],
                        $input["keywords"]
                    );
                }
            }

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
                $fileFormatPath = new FileFormatPath('trstdly', $file);
                $data['slug'] = $fileFormatPath->storeFile();
            }
            $imageBank = ImageBank::create($data);
            $isFormatSupport = $this->isFormat($imageBank->slug);
            if ($isFormatSupport === true) {
                $this->setMetaData(
                    $imageBank->slug,
                    $input["copyright"],
                    $input["description_image"],
                    $input["photographer"],
                    $input["title_image"],
                    $input["keywords"]
                );
            }

            return response()->json([
                'message' => 'Successfully add image',
                'data' => $imageBank
            ], 200);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 500);
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
        $imageBankById = ImageBank::with('createdBy')->where('id', $id)->first();
        //        $this->getMetaData($imageBankById->slug);
        $isFormatSupport = $this->isFormat($imageBankById->slug);
        if ($isFormatSupport === true)
            return view(
                'tools.image-bank.editable',
                [
                    'method' => end($method),
                    'imageBank' => $imageBankById,
                    'fileSize' => $this->getFileSizeImage($imageBankById->slug),
                    'dimension' => $this->getDimensionImage($imageBankById->slug)
                ]
            );
        else
            return back()->withErrors(['error' => $isFormatSupport]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
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

            $this->setMetaData(
                $imageBankById->slug,
                $input["copyright"],
                $input["description"],
                $input["photographer"],
                $input["title"],
                $input["keywords"]
            );

            return redirect()->route('image-bank.index')->with('status', 'Successfully Edit Meta Image');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
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

    public function storeImage(Request $request)
    {
        try {
            $temp = array();
            $uniqueID = request()->header('X-UNIQUE-ID');
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileFormatPath = new FileFormatPath("tmp/$uniqueID", $file);
                array_push($temp, $fileFormatPath->storeFileTemp());
                return response()->json([
                    'message' => 'successfully add image',
                    'data' => $temp,
                    'unique_id' => $uniqueID,
                ], 201);
            }
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function deleteImageTemp(Request $request)
    {
        try {
            Storage::delete($request->name);
            return response()->json([
                'message' => 'successfully delete image',
            ], 201);
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
