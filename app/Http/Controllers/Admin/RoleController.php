<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name', 'asc')->get();
       return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$role->id
        ]);
        
        $role = Role::findOrFail($role->id);
        $role->update([
            'name' => Str::lower($request->input('name'))
        ]);
 
        //assign permission to role
        $role->syncPermissions($request->input('permissions'));
 
        if($role){
            //redirect dengan pesan sukses
            return redirect()->route('admin.roles.index')->with(['success' => 'Role ' . $role['name'] . ' Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.roles.index')->with(['error' => 'Role Gagal Diupdate!']);
        }
    }
}
