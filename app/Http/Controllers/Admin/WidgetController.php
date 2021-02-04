<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Widget;
use Illuminate\Support\Facades\Auth;

class WidgetController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:widgets.index|widgets.create|widgets.delete|widgets.edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.widget.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.widget.create');
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
            'position'       => 'required',
        ];
        
        $value = Str::random(6).'-'.$request->input('title') ;

        // data default
        $data = [
            'title'       => $request->input('title'),
            'slug'     => Str::slug($value),
            'fontawesome'     => $request->input('fontawesome'), 
            'source'     => $request->input('source'), 
            'position' => $request->input('position'),
            'status'     => $request->input('status'), 
            'author_id'   => Auth::id(),
        ];

       
        
        $this->validate($request,($validateData));

        $widget = Widget::create($data);

        if($widget){
            //redirect dengan pesan sukses
            return redirect()->route('admin.widgets.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.widgets.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Widget $widget)
    {
        return view('admin.widget.edit', compact('widget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Widget $widget)
    {
        $validateData = [
            'title' => 'required|min:3',
            'position'       => 'required',
        ];

        $value = $request->input('title').'-'. Str::random(6);

        // data default
        $data = [
            'title'       => $request->input('title'),
            'slug'     => Str::slug($value),
            'fontawesome'     => $request->input('fontawesome'), 
            'source'     => $request->input('source'), 
            'position' => $request->input('position'),
            'status'     => $request->input('status'), 
            'author_id'   => Auth::id(),
        ];

        
        $this->validate($request,($validateData));
       
            $widget->update($data);

        if($widget){
            //redirect dengan pesan sukses
            return redirect()->route('admin.widgets.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.widgets.index')->with(['error' => 'Data Gagal Diperbaharui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Widget $widget)
    {
        $widget->delete();
        

        return response()->json(['success' => true]);

    }

    public function restore(Widget $widget)
    {
        // $widget = Widget::onlyTrashed()->where('slug', $widget);

        $widget->restore();
       
        if($widget){
            //redirect dengan pesan sukses
            return redirect()->back()->with(['success' => 'Data Berhasil Dikembalikan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.widgets.index')->with(['error' => 'Widget is not in trash!']);
        }

    }
    
    public function forceDestroy(Widget $widget)
    {
        // $widget = Widget::withTrashed()->findOrFail($widget->id);
        // cara kedua
        // $widget = Post::witTrashed()->where('id', $id)->first();
        $widget->forceDelete();
        
        // hapus file gambar
        $this->removeImage($widget->image);
        
        
        return redirect('admin/widget?status=trash')->with('success', 'Post permanently deleted');
        
    }
}
