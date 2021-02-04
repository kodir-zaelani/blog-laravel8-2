<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\Categorypost;
use Illuminate\Http\Request;
use App\Models\Subcategorypost;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:posts.index|posts.create|posts.delete|posts.trash']);
        $this->uploadPath = public_path(config('cms.image.directoryPosts'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryposts = Categorypost::orderBy('title', 'asc')->get();
        $subcategoryposts = Subcategorypost::orderBy('title', 'asc')->get();
        $tags = Tag::orderBy('title', 'asc')->get();
        
        return view('admin.post.create', compact('categoryposts','tags', 'subcategoryposts'));
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
            'categorypost_id'   => 'required',
            'content'       => 'required',
        ];
        
        $data = [
            'caption_image'       => $request->input('caption_image'),
            'title'       => $request->input('title'),
            'categorypost_id' => $request->input('categorypost_id'),
            'subcategorypost_id' => $request->input('subcategorypost_id'),
            'setarticle_id' => $request->input('setarticle_id'),
            'slug'        => Str::slug($request->input('title')),
            'headline'     => $request->input('headline'), 
            'selection'     => $request->input('selection'), 
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
                $width = config('cms.image.thumbnailpost.width');
                $height = config('cms.image.thumbnailpost.height');
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

        $post = Post::create($data);

        //assign tags
        $post->tags()->attach($request->input('tags'));

        if($post){
            //redirect dengan pesan sukses
            return redirect()->route('admin.posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.posts.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Post $post)
    {
        $categoryposts = Categorypost::orderBy('title', 'asc')->get();
        $subcategoryposts = Subcategorypost::orderBy('title', 'asc')->get();
        $tags = Tag::orderBy('title', 'asc')->get();
        return view('admin.post.edit', compact('post', 'tags', 'categoryposts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validateData = [
            'title' => 'required|min:3|unique:categoryposts,title,except,id',
            'categorypost_id'   => 'required',
            'content'       => 'required',
        ];
        
        $data = [
            'caption_image'       => $request->input('caption_image'),
            'title'       => $request->input('title'),
            'categorypost_id' => $request->input('categorypost_id'),
            'subcategorypost_id' => $request->input('subcategorypost_id'),
            'setarticle_id' => $request->input('setarticle_id'),
            'slug'        => Str::slug($request->input('title')),
            'headline'     => $request->input('headline'), 
            'selection'     => $request->input('selection'), 
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
        //cek gambar lama
        $oldImage = $post->image;

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
                $width = config('cms.image.thumbnailpost.width');
                $height = config('cms.image.thumbnailpost.height');
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
    
        $post->update($data);

        //assign tags
        $post->tags()->sync($request->input('tags'));

         // Jika gambar lama ada maka lakukan hapus gambar
         if ($oldImage !== $post->image) {
            $this->removeImage($oldImage);
            }

        if($post){
            //redirect dengan pesan sukses
            return redirect()->route('admin.posts.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.posts.index')->with(['error' => 'Data Gagal Diperbaharui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        // hapus file gambar
        $this->removeImage($post->image);

        return response()->json(['success' => true]);
    }

    /**
     * Get Sub Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsubcategorypost($categorypost_id)
    {
        // menampilkan data menggynakan Query builder buka elequent
        $subcategory = DB::table('subcategoryposts')->where('categorypost_id', $categorypost_id)->get();
        return response()->json($subcategory);
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
