<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function profile()
    {
        return view('admin.user.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        return view('admin.user.edit', compact('user', 'roles'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$user->id,
            
        ]);

        $user = User::findOrFail($user->id);
       
        if($request->input('password') == "") {
            $user->update([
                'name'      => $request->input('name'),
                'slug'      => Str::slug($request->input('name'), '-'),
                'email'     => $request->input('email')
            ]);
        } else {
            $user->update([
                'name'      => $request->input('name'),
                'slug'      => Str::slug($request->input('name'), '-'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password'))
            ]);
        }

        //assign role
        $user->syncRoles($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('admin.users.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.users.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}
