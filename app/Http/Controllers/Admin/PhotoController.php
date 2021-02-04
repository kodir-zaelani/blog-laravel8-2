<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:photos.index|photos.create|photos.delete|photos.trash']);
        $this->uploadPath = public_path(config('cms.image.directoryPhotos'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.photo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albums = Album::orderBy('title', 'asc')->get();
        return view('admin.photo.create', compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'album_id' => 'required',
            'image' => 'required|image|max:2000',
        ]);
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
                $width = config('cms.image.thumbnailalbum.width');
                $height = config('cms.image.thumbnailalbum.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                image::make($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            
            $Photo = Photo::create([
                'image'       => $image_data,
                'title'       => $request->input('title'),
                'album_id'       => $request->input('album_id'),
                'slug'        => Str::random(10),
                'caption'     => $request->input('caption'),  
            ]);
        }
        else {

            $Photo = Photo::create([
                'title'       => $request->input('title'),
                'slug'        => Str::random(10),
                'album_id'    => $request->input('album_id'),
                'caption'     => $request->input('caption'),  
            ]);

        }
    
        $Photo->save();

        if($Photo){
            //redirect dengan pesan sukses
            return redirect()->route('admin.photos.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.photos.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Photo $photo)
    {
        $albums = Album::orderBy('title', 'asc')->get();
        return view('admin.photo.edit', compact('albums', 'photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'album_id' => 'required',
            'image' => 'required|image|max:2000',
        ]);

         //cek gambar lama
         $oldImage = $photo->image;

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
                $width = config('cms.image.thumbnailalbum.width');
                $height = config('cms.image.thumbnailalbum.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                image::make($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            
            $photo_date = [
                'image'       => $image_data,
                'title'       => $request->input('title'),
                'album_id'       => $request->input('album_id'),
                'caption'     => $request->input('caption'),   
            ];
        }
        else {

            $photo_date = [
                'title'       => $request->input('title'),
                'album_id'    => $request->input('album_id'),
                'caption'     => $request->input('caption'),  
            ];

        }
    
        $photo->update($photo_date);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $photo->image) {
            $this->removeImage($oldImage);
            }

        if($photo){
            //redirect dengan pesan sukses
            return redirect()->route('admin.photos.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.photos.index')->with(['error' => 'Data Gagal Diperbaharui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {

        $photo->delete();

        // hapus file gambar
        $this->removeImage($photo->image);

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
