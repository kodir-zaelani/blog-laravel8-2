<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setarticle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SetarticleController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:setarticles.index|setarticles.create|setarticles.delete|setarticles.trash']);
        $this->uploadPath = public_path(config('cms.image.directorySetarticle'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setarticle.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setarticle.create');
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
            'title' => 'required|min:3|unique:setarticles,title',
        ];
        
        $data = [
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
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
            
            $successUploaded = $image->move($destination, $fileName);
            
            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailsetarticle.width');
                $height = config('cms.image.thumbnailsetarticle.height');
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

        $setarticle = Setarticle::create($data);

        // $setarticle->save();

        if($setarticle){
            //redirect dengan pesan sukses
            return redirect()->route('admin.setarticles.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.setarticles.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Setarticle $setarticle )
    {
        return view('admin.setarticle.edit', compact('setarticle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setarticle $setarticle)
    {
        //cek gambar lama
        $oldImage = $setarticle->image;
        
        $validateData = [
            'title' => 'required|min:3|unique:setarticles,title,except,id',
        ];
        
        $data = [
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
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
             
             $successUploaded = $image->move($destination, $fileName);
             
             if ($successUploaded) {
                 # script dibawah koneksi ke file App\confog\cms.php
                 $width = config('cms.image.thumbnailsetarticle.width');
                 $height = config('cms.image.thumbnailsetarticle.height');
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
         
     
         $setarticle->update($data);
 
          // Jika gambar lama ada maka lakukan hapus gambar
          if ($oldImage !== $setarticle->image) {
             $this->removeImage($oldImage);
             }

        if($setarticle){
            //redirect dengan pesan sukses
            return redirect()->route('admin.setarticles.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            session()->flash('error', 'Data Gagal Diupdate!');
            return redirect()->route('admin.setarticles.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setarticle $setarticle)
    {
        $setarticle->delete();
        // hapus file gambar
        $this->removeImage($setarticle->image);
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
