<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Categorydownload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategorydownloadController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:categorydownloads.index|categorydownloads.create|categorydownloads.delete|categorydownloads.edit']);
        $this->uploadPath = public_path(config('cms.image.directoryCategoryposts'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categorydownload.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorydownload.create');
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
            'title' => 'required|min:3|unique:categorydownloads,title',
        ];
        
        $data = [
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'author_id'   => Auth::id(),
        ];

        if (!empty($this->image)) {
            // Append to the validation if image is not empty
            $validateData = array_merge($validateData, [
                'image' => 'image|mimes:jpeg,jpg,png|max:2500',
            ]);
        }

        //upload image 
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = time().$image->getClientOriginalName();
            $destination = $this->uploadPath;
            
            $successUploaded = Image::make($image)->resize(600,350);
            $successUploaded->save($destination . $fileName, 80);
            
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

        $categorydownload = Categorydownload::create($data);

        if($categorydownload){
            //redirect dengan pesan sukses
            return redirect()->route('admin.categorydownloads.index')->with(['success' => 'Data Category '.$categorydownload['title'].' Berhasil  Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.categorydownloads.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Categorydownload $categorydownload )
    {
        return view('admin.categorydownload.edit', compact('categorydownload'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorydownload $categorydownload)
    {
        //cek gambar lama
        $oldImage = $categorydownload->image;
        
        $validateData = [
            'title' => 'required|min:3',

            // 'title' => 'required|min:3', 
            // Rule::unique('categorydownloads')->ignore($categorydownload->title),
        ];
        
        $data = [
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'author_id'   => Auth::id(),
        ];

        if (!empty($this->image)) {
            // Append to the validation if image is not empty
            $validateData = array_merge($validateData, [
                'image' => 'image|mimes:jpeg,jpg,png|max:2500',
            ]);
        }

         //upload image (cara kedua)
         if ($request->has('image')) {
             # upload with image
             $image = $request->file('image');
             $fileName = time().$image->getClientOriginalName();
             $destination = $this->uploadPath;
             
             $successUploaded = Image::make($image)->resize(600,350);
            $successUploaded->save($destination . $fileName, 80);
             
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
     
         $categorydownload->update($data);
 
          // Jika gambar lama ada maka lakukan hapus gambar
          if ($oldImage !== $categorydownload->image) {
             $this->removeImage($oldImage);
             }

        if($categorydownload){
            //redirect dengan pesan sukses
            return redirect()->route('admin.categorydownloads.index')->with(['success' => 'Data Category '.$categorydownload['title'].' Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            session()->flash('error', 'Data Gagal Diupdate!');
            return redirect()->route('admin.categorydownloads.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorydownload $categorydownload)
    {
        $categorydownload->delete();
         // hapus file gambar
         $this->removeImage($categorydownload->image);
         
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
}
