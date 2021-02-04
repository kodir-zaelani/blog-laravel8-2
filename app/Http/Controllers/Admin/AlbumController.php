<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class AlbumController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:albums.index|albums.create|albums.delete|albums.edit']);
        $this->uploadPath                 = public_path(config('cms.image.directoryAlbums'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.album.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          //upload image (cara kedua)
          if ($request->has('image')) {
            # upload with image
            $image                        = $request->file('image');
            $fileName                     = time().$image->getClientOriginalName();
            $destination                  = $this->uploadPath;
            
            $successUploaded              = Image::make($image)->resize(600,350);
            $successUploaded->save($destination . $fileName, 80);
            
            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width                    = config('cms.image.thumbnailalbum.width');
                $height                   = config('cms.image.thumbnailalbum.height');
                $extension                = $image->getClientOriginalExtension();
                $thumbnail                = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                image::make($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data                   = $fileName;
            
            $album = Album::create([
                'image'       => $image_data,
                'title'       => $request->input('title'),
                'slug'        => Str::slug($request->input('title')),
                'description' => $request->input('description'),  
            ]);
        }
        else {

            $album = Album::create([
                'title'       => $request->input('title'),
                'slug'        => Str::slug($request->input('title')),
                'description' => $request->input('description'),  
            ]);

        }
    
        $album->save();

        if($album){
            //redirect dengan pesan sukses
            return redirect()->route('admin.albums.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.albums.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('admin.album.edit', compact('album'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
         //cek gambar lama
         $oldImage                        = $album->image;

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image                        = $request->file('image');
            $fileName                     = time().$image->getClientOriginalName();
            $destination                  = $this->uploadPath;
            
            $successUploaded              = Image::make($image)->resize(600,350);
            $successUploaded->save($destination . $fileName, 80);
            
            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width                    = config('cms.image.thumbnailalbum.width');
                $height                   = config('cms.image.thumbnailalbum.height');
                $extension                = $image->getClientOriginalExtension();
                $thumbnail                = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                image::make($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data                   = $fileName;
            
            $album_data = [
                'image'       => $image_data,
                'title'       => $request->input('title'),
                'slug'        => Str::slug($request->input('title')),
                'description' => $request->input('description'),  
            ];
        }
        else {

            $album_data = [
                'title'       => $request->input('title'),
                'slug'        => Str::slug($request->input('title')),
                'description' => $request->input('description'),  
            ];

        }
    
        $album->update($album_data);

        // Jika gambar lama ada maka lakukan hapus gambar
        if ($oldImage !== $album->image) {
            $this->removeImage($oldImage);
            }

        if($album){
            //redirect dengan pesan sukses
            return redirect()->route('admin.albums.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.albums.index')->with(['error' => 'Data Gagal Diperbaharui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();

        // hapus file gambar
        $this->removeImage($album->image);

        return response()->json(['success' => true]);
    }

    // function remove image
    private function removeImage($image)
    {
        if ( ! empty($image) )
        {
            $imagePath                    = $this->uploadPath . '/' . $image;
            $ext                          = substr(strrchr($image, '.'), 1);
            $thumbnail                    = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath                = $this->uploadPath . '/' . $thumbnail;
            
            if ( file_exists($imagePath) ) unlink($imagePath);
            if ( file_exists($thumbnailPath) ) unlink($thumbnailPath);
        }
    }
}
