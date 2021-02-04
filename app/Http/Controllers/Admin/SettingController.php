<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    protected $uploadPath;
    /**
    * __construct
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware(['permission:settings.index|settings.create|settings.delete']);
        $this->uploadPath = public_path(config('cms.image.directoryLogo'));
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $setting = Setting::find(1);
        return view('admin.setting.index', compact('setting') );
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Setting $setting)
    {
         //cek gambar lama
         $oldImage = $setting->image;
         
         $oldLogo = $setting->logo;
        
         $oldFavicon = $setting->favicon;

        $validateData = [
            'title' =>'required|min:3',
        ];
        
        $data = [
            'title'       => $request->input('title'),
            'tagline'       => $request->input('tagline'),
            'description'       => $request->input('description'),
            'website'       => $request->input('website'),
            'email'       => $request->input('email'),
            'meta_description'       => $request->input('meta_description'),
            'meta_key'       => $request->input('meta_key'),
        ];

        if (!empty($this->image)) {
            // Append to the validation if image is not empty
            $validateData = array_merge($validateData, [
                'image' => 'image|mimes:jpeg,jpg,png|max:2500',
            ]);
        }
        if (!empty($this->logo)) {
            // Append to the validation if logo is not empty
            $validateData = array_merge($validateData, [
                'logo' => 'image|mimes:jpeg,jpg,png|max:2500',
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
                $width = 200;
                $height = 150;
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                image::make($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            $image_data = $fileName;
            
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'image' => $image_data
            ]); 
           
        }
        //upload image (cara kedua)
        if ($request->has('logo')) {
            # upload with logo
            $logo = $request->file('logo');
            $fileName = time().$logo->getClientOriginalName();
            $destination = $this->uploadPath;
            
            $successUploaded = $logo->move($destination, $fileName);
            
            if ($successUploaded) {
                $width = 200;
                $height = 150;
                $extension = $logo->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                image::make($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            $logo_data = $fileName;
            
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'logo' => $logo_data
            ]); 
           
        }

        if (!empty($this->favicon)) {
            // Append to the validation if favicon is not empty
            $validateData = array_merge($validateData, [
                'favicon' => 'image|mimes:jpeg,jpg,png|max:2500',
            ]);
        }

        if ($request->has('favicon')) {
            $image = $request->file('favicon');
            $fileName = time().$image->getClientOriginalName();
            $destination = $this->uploadPath;
            
            $successUploaded = $image->move($destination, $fileName);
            
            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailfavicon.width');
                $height = config('cms.image.thumbnailfavicon.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                image::make($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $favicon_data = $fileName;

            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'favicon' => $favicon_data
            ]); 

        }

            $this->validate($request,($validateData));

            $setting->update($data);
            
            // Jika gambar lama ada maka lakukan hapus gambar
            if ($oldImage !== $setting->image) {
                $this->removeImage($oldImage);
            }

            if ($oldLogo !== $setting->logo) {
                $this->removeImage($oldLogo);
                }

            if ($oldFavicon !== $setting->favicon) {
                $this->removeImage($oldFavicon);
                }
            
            if($setting){
                //redirect dengan pesan sukses
                return redirect()->route('admin.settings.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
            }
            else {
                //redirect dengan pesan error
                return redirect()->route('admin.settings.index')->with(['error' => 'Data Gagal Diperbaharui!']);
            }
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
    