<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Str;
use App\Models\Categorypost;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Exports\CategorypostExport;
use App\Imports\CategorypostImport;
use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;

class CategorypostController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:categoryposts.index|categoryposts.create|categoryposts.delete|categoryposts.trash']);
        $this->uploadPath = public_path(config('cms.image.directoryCategorypost'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categorypost.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorypost.create');
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

        $categorypost = Categorypost::create($data);

        if($categorypost){
            //redirect dengan pesan sukses
            return redirect()->route('admin.categoryposts.index')->with(['success' => 'Data Category '.$categorypost['title'].' Berhasil  Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.categoryposts.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Categorypost $categorypost )
    {
        return view('admin.categorypost.edit', compact('categorypost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorypost $categorypost)
    {
        //cek gambar lama
        $oldImage = $categorypost->image;
        
        $validateData = [
            'title' => 'required|min:3',

            // 'title' => 'required|min:3', 
            // Rule::unique('categoryposts')->ignore($categorypost->title),
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
     
         $categorypost->update($data);
 
          // Jika gambar lama ada maka lakukan hapus gambar
          if ($oldImage !== $categorypost->image) {
             $this->removeImage($oldImage);
             }

        if($categorypost){
            //redirect dengan pesan sukses
            return redirect()->route('admin.categoryposts.index')->with(['success' => 'Data Category '.$categorypost['title'].' Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            session()->flash('error', 'Data Gagal Diupdate!');
            return redirect()->route('admin.categoryposts.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorypost $categorypost)
    {
        $categorypost->delete();
         // hapus file gambar
         $this->removeImage($categorypost->image);
         
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
     * importSave
     *
     * @param  mixed $request
     * @return void
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

        //JIKA FILE-NYA ADA
        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            Excel::import(new CategorypostImport(), $file); //IMPORT FILE 
            return redirect()->back()->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function export()
    {
        return Excel::download(new CategorypostExport, 'cateporypost.xlsx');
    }

    // public function printPDF()
    // {
    //     $categoryposts = Categorypost::all();

    //     $pdf = PDF::loadview('categorypost_pdf',['categoryposts'=>$categoryposts]);
    //     return $pdf->download('list-category-pdf');
    //     // return Excel::download(new CategorypostExport, 'cateporypost.pdf');
    // }
    public function printPDF()
    {
        $employe = Employe::all();

        $pdf = PDF::loadview('employe_pdf',['employe'=>$employe]);
        return $pdf->download('list-employe-pdf.pdf');
    }
}
