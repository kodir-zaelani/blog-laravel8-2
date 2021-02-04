<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advertisement;
use Illuminate\Support\Str;
use App\Models\Categorypage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class AdvertisementController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:advertisements.index|advertisements.create|advertisements.delete|advertisements.edit']);
        $this->uploadPath = public_path(config('cms.image.directoryAdvertisements'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.advertisement.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertisement.create');
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
            'title' => 'required|min:3',
            'url'       => 'required|url',
            'position'       => 'required',
        ];
        
        $value = Str::random(6).'-'.$request->input('title') ;

        // data default
        $data = [
            'title'       => $request->input('title'),
            'slug'     => Str::slug($value),
            'url'     => $request->input('url'), 
            'source'     => $request->input('source'), 
            'position' => $request->input('position'),
            'status'     => $request->input('status'), 
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
                $width = config('cms.image.thumbnailadvertisement.width');
                $height = config('cms.image.thumbnailadvertisement.height');
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

        $advertisement = Advertisement::create($data);

        if($advertisement){
            //redirect dengan pesan sukses
            return redirect()->route('admin.advertisements.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.advertisements.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Advertisement $advertisement)
    {
        return view('admin.advertisement.edit', compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        $validateData = [
            'title' => 'required|min:3',
            'url'       => 'required',
        ];

        $value = $request->input('title').'-'. Str::random(6);

        // data default
        $data = [
            'title'       => $request->input('title'),
            'slug'     => Str::slug($value),
            'url'     => $request->input('url'), 
            'source'     => $request->input('source'), 
            'position' => $request->input('position'),
            'status'     => $request->input('status'), 
            'author_id'   => Auth::id(),
        ];

        //cek gambar lama
        $oldImage = $advertisement->image;

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
                $width = config('cms.image.thumbnailadvertisement.width');
                $height = config('cms.image.thumbnailadvertisement.height');
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
       
            $advertisement->update($data);

            // Jika gambar lama ada maka lakukan hapus gambar
            if ($oldImage !== $advertisement->image) {
                $this->removeImage($oldImage);
                }

        if($advertisement){
            //redirect dengan pesan sukses
            return redirect()->route('admin.advertisements.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.advertisements.index')->with(['error' => 'Data Gagal Diperbaharui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
         // hapus file gambar
         $this->removeImage($advertisement->image);

        return response()->json(['success' => true]);

    }

    public function restore(Advertisement $advertisement)
    {
        // $advertisement = Advertisement::onlyTrashed()->where('slug', $advertisement);

        $advertisement->restore();
       
        if($advertisement){
            //redirect dengan pesan sukses
            return redirect()->back()->with(['success' => 'Data Berhasil Dikembalikan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.advertisements.index')->with(['error' => 'Advertisement is not in trash!']);
        }

    }
    
    public function forceDestroy(Advertisement $advertisement)
    {
        // $advertisement = Advertisement::withTrashed()->findOrFail($advertisement->id);
        // cara kedua
        // $advertisement = Post::witTrashed()->where('id', $id)->first();
        $advertisement->forceDelete();
        
        // hapus file gambar
        $this->removeImage($advertisement->image);
        
        
        return redirect('admin/advertisement?status=trash')->with('success', 'Post permanently deleted');
        
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
