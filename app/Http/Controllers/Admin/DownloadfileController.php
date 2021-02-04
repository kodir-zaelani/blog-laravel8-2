<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Downloadfile;
use Illuminate\Http\Request;
use App\Models\Categorydownload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DownloadfileController extends Controller
{
    protected $uploadPath;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:downloadfiles.index|downloadfiles.create|downloadfiles.delete|downloadfiles.edit']);
        $this->uploadPath = public_path('uploads/downloadfiles');
    }

    public function index()
    {
        return view('admin.downloadfile.index');
    }

    public function create()
    {
        $categorydownloads = Categorydownload::orderBy('title', 'asc')->get();
        return view('admin.downloadfile.create', compact('categorydownloads'));
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
            'title' => 'required|min:3|unique:downloadfiles,title',
            'categorydownload_id' => 'required',
        ];
        
        $data = [
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'categorydownload_id'       => $request->input('categorydownload_id'),
            'author_id'   => Auth::id(),
        ];

        if (!empty($this->file)) {
            // Append to the validation if file is not empty
            $validateData = array_merge($validateData, [
            'file' => 'mimes:pdf,xlx,xlsx,doc,docx,ppt,pptx,wps,dps,et'
            ]);
        }
        
        //upload image 
        if ($request->has('file')) {
            # upload with image
            $fileDoc = $request->file('file');
            $fileName = time().'-'.$fileDoc->getClientOriginalName();
            $destination = $this->uploadPath;
            
            $request->file->move($destination, $fileName);

            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'file' => $fileName
            ]); 
        }

        
        if ($request->has('linkfile')) {
            // Append to the validation if filename is not empty
            $data = array_merge($data, [
                'linkfile' => $request->input('linkfile'),
            ]); 
        }
        
        $this->validate($request,($validateData));

        $downloadfile = Downloadfile::create($data);

        if($downloadfile){
            //redirect dengan pesan sukses
            return redirect()->route('admin.downloadfiles.index')->with(['success' => 'Data Download '.$downloadfile['title'].' Berhasil  Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.downloadfiles.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Downloadfile $downloadfile )
    {
        $categorydownloads = Categorydownload::orderBy('title', 'asc')->get();
        return view('admin.downloadfile.edit', compact('downloadfile', 'categorydownloads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Downloadfile $downloadfile)
    {
        //cek gambar lama
        $oldFile = $downloadfile->file;
        
        $validateData = [
            'title' => 'required|min:3',
            'categorydownload_id' => 'required',
        ];
        
        $data = [
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'categorydownload_id'       => $request->input('categorydownload_id'),
            'author_id'   => Auth::id(),
        ];

        if (!empty($this->file)) {
            // Append to the validation if file is not empty
            $validateData = array_merge($validateData, [
            'file' => 'mimes:pdf,xlx,xlsx,doc,docx,ppt,pptx,wps,dps,et'
            ]);
        }
        
        //upload image 
        if ($request->has('file')) {
            # upload with image
            $fileDoc = $request->file('file');
            $fileName = time().'-'.$fileDoc->getClientOriginalName();
            $destination = $this->uploadPath;
            
            $request->file->move($destination, $fileName);

            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'file' => $fileName
            ]); 
        }

        
        if ($request->has('linkfile')) {
            // Append to the validation if filename is not empty
            $data = array_merge($data, [
                'linkfile' => $request->input('linkfile'),
            ]); 
        }
        
         
         $this->validate($request,($validateData));
     
         $downloadfile->update($data);
 
          // Jika gambar lama ada maka lakukan hapus gambar
          if ($oldFile !== $downloadfile->file) {
             $this->removeImage($oldFile);
             }

        if($downloadfile){
            //redirect dengan pesan sukses
            return redirect()->route('admin.downloadfiles.index')->with(['success' => 'Data Download '.$downloadfile['title'].' Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            session()->flash('error', 'Data Gagal Diupdate!');
            return redirect()->route('admin.downloadfiles.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Downloadfile $downloadfile)
    {
        $downloadfile->delete();
         // hapus file gambar
         $this->removeImage($downloadfile->file);
         
        return response()->json(['success' => true]);
    }

    // function remove image
    private function removeImage($fileDoc)
    {
        if ( ! empty($fileDoc) )
        {
            $imagePath     = $this->uploadPath . '/' . $fileDoc;
            if ( file_exists($imagePath) ) unlink($imagePath);
        }
    }
}
