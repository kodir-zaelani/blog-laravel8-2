<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Categorypost;
use Illuminate\Http\Request;
use App\Models\Subcategorypost;
use App\Http\Controllers\Controller;
use App\Imports\SubcategorypostImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;

class SubcategorypostController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:subcategoryposts.index|subcategoryposts.create|subcategoryposts.delete|subcategoryposts.edit']);
        $this->uploadPath = public_path(config('cms.image.directoryCategorypost'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subcategorypost.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryposts = Categorypost::orderBy('title', 'asc')->get();
        return view('admin.subcategorypost.create', compact('categoryposts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = [
            'title' => 'required|min:3|unique:categoryposts,title',
            'categorypost_id' => 'required',
        ];
        
        $data = [
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'categorypost_id'       => $request->input('categorypost_id'),
            'author_id'   => Auth::id(),
        ];

        if (!empty($this->image)) {
            // Append to the validation if image is not empty
            $validateData = array_merge($validateData, [
                'image' => 'image|mimes:jpeg,jpg,png|max:2000',
            ]);
        }

        //upload image 
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = time().$image->getClientOriginalName();
            $destination = $this->uploadPath;
            
            $successUploaded = $image->move($destination, $fileName);
            
            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailcategorypost.width');
                $height = config('cms.image.thumbnailcategorypost.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                image::make($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'image' => $image_data
            ]);

        }

        $this->validate($request,($validateData));

        $subcategorypost = Subcategorypost::create($data);

        if($subcategorypost){
            //redirect dengan pesan sukses
            return redirect()->route('admin.subcategoryposts.index')->with(['success' => 'Data Category '.$subcategorypost['title'].' Berhasil  Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.subcategoryposts.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Subcategorypost $subcategorypost )
    {
        $categoryposts = Categorypost::orderBy('title', 'asc')->get();

        return view('admin.subcategorypost.edit', compact('subcategorypost', 'categoryposts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategorypost $subcategorypost)
    {

        $validateData = [
            'title' => 'required|min:3|unique:setarticles,title,except,id',
            'categorypost_id' => 'required',
        ];
        
        $data = [
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'categorypost_id'       => $request->input('categorypost_id'),
            'author_id'   => Auth::id(),
        ];

        if (!empty($this->image)) {
            // Append to the validation if image is not empty
            $validateData = array_merge($validateData, [
                'image' => 'image|mimes:jpeg,jpg,png|max:2000',
            ]);
        }

         //cek gambar lama
         $oldImage = $subcategorypost->image;

         //upload image (cara kedua)
         if ($request->has('image')) {
             # upload with image
             $image = $request->file('image');
             $fileName = time().$image->getClientOriginalName();
             $destination = $this->uploadPath;
             
             $successUploaded = $image->move($destination, $fileName);
             
             if ($successUploaded) {
                 # script dibawah koneksi ke file App\confog\cms.php
                 $width = config('cms.image.thumbnailcategorypost.width');
                 $height = config('cms.image.thumbnailcategorypost.height');
                 $extension = $image->getClientOriginalExtension();
                 $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                 
                 image::make($destination . '/' . $fileName)
                 ->resize($width, $height)
                 ->save($destination . '/' . $thumbnail);
             }
 
             // Tampung isi image ke variable data
             $image_data = $fileName;
             
             $subcategorypost_data = [
                 'image'       => $image_data,
                 'categorypost_id'       => $request->input('categorypost_id'),
                 'title'       => $request->input('title'),
                 'slug'        => Str::slug($request->input('title')),
                 'author_id'   => Auth::id(),
             ];
         }
         else {
 
             $subcategorypost_data = [
                 'categorypost_id'       => $request->input('categorypost_id'),
                 'title'       => $request->input('title'),
                 'slug'        => Str::slug($request->input('title')),
                 'author_id'   => Auth::id(),
             ];
 
         }
     
         $subcategorypost->update($subcategorypost_data);
 
          // Jika gambar lama ada maka lakukan hapus gambar
          if ($oldImage !== $subcategorypost->image) {
             $this->removeImage($oldImage);
             }

        if($subcategorypost){
            //redirect dengan pesan sukses
            return redirect()->route('admin.subcategoryposts.index')->with(['success' => 'Data Category '.$subcategorypost['title'].' Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            session()->flash('error', 'Data Gagal Diupdate!');
            return redirect()->route('admin.subcategoryposts.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategorypost $subcategorypost)
    {
        $subcategorypost->delete();
         // hapus file gambar
         $this->removeImage($subcategorypost->image);
         
        return response()->json(['success' => true]);
    }

    // function remove image
    private function removeImage($image)
    {
        if ( ! empty($image) )
        {
            $imagePath     = $this->uploadPath . '/' . $image;
            $ext           = substr(strrchr($image, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;
            
            if ( file_exists($imagePath) ) unlink($imagePath);
            if ( file_exists($thumbnailPath) ) unlink($thumbnailPath);
        }
    }

    /**
     * Import a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importSave(Request $request)
    {
        //VALIDASI DATA YANG DIKIRIM
        $this->validate($request,[
            'file' => 'required|mimes:csv,xls,xlsx'
        ],
        [
            'file.required' => 'Pilih File untuk di Import',
            'file.mimes' => 'File Tidak Valid'
        ]);

        $categorypost = $request->input('categorypost_id');
            // dd($categorypost);
        //JIKA FILE-NYA ADA
        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            Excel::import(new SubcategorypostImport($categorypost), $file); //IMPORT FILE 
            return redirect()->back()->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }
}
