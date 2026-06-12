<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User; 
use App\Models\UserRole;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //select * from users
        //latest:desc
        //oldest:asc
        //$users = User::latest()->get(); --ini yg terbaru--
        // $users = User::orderBy('id', 'desc')->get();
        $userRoles = UserRole::with('user', 'role')->orderByDesc('id')->get();
        $title = "User Role Management";
        return view('user-role.index', compact('userRoles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get(); 
        $roles = Role::get(); 
        $title = "Create New User Role";
        return view('user-role.create', compact('title', 'users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //insert into users () values()
        $validate = $request->validate([
            'user_id'=> 'required', 
            'role_id' => 'required', 
        ]);

        UserRole::create($request->all());
        Alert::success('Success!', 'Create User Role Success');
        return redirect()->to('user-role'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit User";
        $edit = User::find($id); //blank
        //$edit = User::findOrFail($id); 404
        return view('user.edit', compact('title', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'name' => $request->name, 
            'email' => $request->email, 
        ];

        //jika user memasukan password
        if(filled($request->password)){
            $data['password'] = $request->password; 
        }

        User::find($id)->update($data); 
        return redirect()->to('user'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->to('user'); 
    }
}
