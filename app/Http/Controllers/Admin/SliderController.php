<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;

class SliderController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:sliders.index|sliders.create|sliders.delete|sliders.trash']);
        $this->uploadPath = public_path(config('cms.image.directorySliders'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.slider.index');
    }

    private function statusList($request)
    {
        return [
            // 'own'       => ($tmp = $request->user()->sliders()) ? $tmp->count() : 0,
            // 'all'       => Slider::count(),
            'published & Draft ' => ($tmp = Slider::published()) ? $tmp->count() : 0,
            // 'draft'     => ($tmp = Slider::draft()) ? $tmp->count() : 0,
            'trash'     => ($tmp = Slider::onlyTrashed()) ? $tmp->count() : 0,
        ];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderStoreRequest $request)
    {
        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = time().$image->getClientOriginalName();
            $destination = $this->uploadPath;
            
            $successUploaded = $image->move($destination, $fileName);
            
            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailslider.width');
                $height = config('cms.image.thumbnailslider.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                image::make($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;
            
        }
    
            $slider = Slider::create([
                'image'       => $image_data,
                'title'       => $request->input('title'),
                'short_title'       => $request->input('short_title'),
                'slug'        => Str::slug($request->input('title')),
                'link'     => $request->input('link'),  
                'video'     => $request->input('video'),  
                'excerpt'     => Str::limit($request->input('excerpt'), 100),
                'show_attribute'     => $request->input('show_attribute'),  
                'status'     => $request->input('status'), 
                'author_id'   => Auth::id(),
            ]);


        if($slider){
            //redirect dengan pesan sukses
            return redirect()->route('admin.sliders.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.sliders.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', [
            'slider' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderUpdateRequest $request, Slider $slider)
    {
        // dd($request->all());
        //cek gambar lama
        $oldImage = $slider->image;

        //upload image (cara kedua)
        if ($request->has('image')) {
            # upload with image
            $image = $request->file('image');
            $fileName = time().$image->getClientOriginalName();
            $destination = $this->uploadPath;
            
            $successUploaded = $image->move($destination, $fileName);
            
            if ($successUploaded) {
                # script dibawah koneksi ke file App\confog\cms.php
                $width = config('cms.image.thumbnailslider.width');
                $height = config('cms.image.thumbnailslider.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                image::make($destination . '/' . $fileName)
                ->resize($width, $height)
                ->save($destination . '/' . $thumbnail);
            }

            // Tampung isi image ke variable data
            $image_data = $fileName;

            $slide_data = [
                'image'       => $image_data,
                'title'       => $request->input('title'),
                'short_title'       => $request->input('short_title'),
                'slug'        => Str::slug($request->input('title')),
                'link'     => $request->input('link'),  
                'video'     => $request->input('video'),  
                'excerpt'     => Str::limit($request->input('excerpt'), 100),
                'show_attribute'     => $request->input('show_attribute'),  
                'status'     => $request->input('status'), 
                'author_id'   => Auth::id() 
            ];
            
        } else {
            $slide_data = [
                'title'       => $request->input('title'),
                'short_title'       => $request->input('short_title'),
                'slug'        => Str::slug($request->input('title')),
                'link'     => $request->input('link'),  
                'video'     => $request->input('video'),  
                'excerpt'     => Str::limit($request->input('excerpt'), 100),
                'show_attribute'     => $request->input('show_attribute'),  
                'status'     => $request->input('status'), 
                'author_id'   => Auth::id() 
            ];
        }
       
            
            $slider->update($slide_data);

            // Jika gambar lama ada maka lakukan hapus gambar
            if ($oldImage !== $slider->image) {
                $this->removeImage($oldImage);
                }

        if($slider){
            //redirect dengan pesan sukses
            return redirect()->route('admin.sliders.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.sliders.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        // hapus file gambar
        $this->removeImage($slider->image);

        return response()->json(['success' => true]);

    }
    
    public function restore(Slider $slider)
    {
        $slider = Slider::onlyTrashed()->where('slug', $slider);

        $slider->restore();
       
        if($slider){
            //redirect dengan pesan sukses
            return redirect()->back()->with(['success' => 'Data Berhasil Dikembalikan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.sliders.index')->with(['error' => 'Slider is not in trash!']);
        }

    }
    
    public function forceDestroy(Slider $slider)
    {
        // $slider = Slider::withTrashed()->findOrFail($slider->id);
        // cara kedua
        // $slider = Post::witTrashed()->where('id', $id)->first();
        $slider->forceDelete();
        
        // hapus file gambar
        $this->removeImage($slider->image);
        
        
        return redirect('admin/sliders?status=trash')->with('success', 'Post permanently deleted');
        
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
