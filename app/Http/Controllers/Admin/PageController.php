<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Support\Str;
use App\Models\Categorypage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class PageController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:pages.index|pages.create|pages.delete|pages.trash']);
        $this->uploadPath = public_path(config('cms.image.directoryPages'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorypages = Categorypage::all();
        return view('admin.page.create', compact('categorypages'));
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
            'title' => 'required|min:3|unique:pages,title',
            'categorypage_id'   => 'required',
            'content'       => 'required',
        ];
        
        $data = [
            'caption_image'       => $request->input('caption_image'),
            'title'       => $request->input('title'),
            'categorypage_id' => $request->input('categorypage_id'),
            'slug'        => Str::slug($request->input('title')),
            'video'     => $request->input('video'), 
            'caption_video'     => $request->input('caption_video'), 
            'content'     => $request->input('content'),  
            'excerpt'     => Str::limit($request->input('content'), 100),
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
                $width = config('cms.image.thumbnailpage.width');
                $height = config('cms.image.thumbnailpage.height');
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

        $page = Page::create($data);

        if($page){
            //redirect dengan pesan sukses
            return redirect()->route('admin.pages.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.pages.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Page $page)
    {
        $categorypages = Categorypage::all();
        return view('admin.page.edit', compact('categorypages', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $validateData = [
            'title' => 'required|min:3',
            'categorypage_id'   => 'required',
            'content'       => 'required',
        ];
        
        $data = [
            'caption_image'       => $request->input('caption_image'),
            'title'       => $request->input('title'),
            'categorypage_id' => $request->input('categorypage_id'),
            'slug'        => Str::slug($request->input('title')),
            'video'     => $request->input('video'), 
            'caption_video'     => $request->input('caption_video'), 
            'content'     => $request->input('content'),  
            'excerpt'     => Str::limit($request->input('content'), 100),
            'status'     => $request->input('status'), 
            'author_id'   => Auth::id(),
        ];

        //cek gambar lama
        $oldImage = $page->image;

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
                $width = config('cms.image.thumbnailpage.width');
                $height = config('cms.image.thumbnailpage.height');
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
       
            $page->update($data);

            // Jika gambar lama ada maka lakukan hapus gambar
            if ($oldImage !== $page->image) {
                $this->removeImage($oldImage);
                }

        if($page){
            //redirect dengan pesan sukses
            return redirect()->route('admin.pages.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.pages.index')->with(['error' => 'Data Gagal Diperbaharui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
         // hapus file gambar
         $this->removeImage($page->image);

        return response()->json(['success' => true]);

    }

    public function restore(Page $page)
    {
        // $page = Page::onlyTrashed()->where('slug', $page);

        $page->restore();
       
        if($page){
            //redirect dengan pesan sukses
            return redirect()->back()->with(['success' => 'Data Berhasil Dikembalikan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.pages.index')->with(['error' => 'Page is not in trash!']);
        }

    }
    
    public function forceDestroy(Page $page)
    {
        // $page = Page::withTrashed()->findOrFail($page->id);
        // cara kedua
        // $page = Post::witTrashed()->where('id', $id)->first();
        $page->forceDelete();
        
        // hapus file gambar
        $this->removeImage($page->image);
        
        
        return redirect('admin/pages?status=trash')->with('success', 'Post permanently deleted');
        
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
