<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User; 
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
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
        $users = User::orderByDesc('id')->get();
        $title = "User Management";
        return view('user.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New User";
        $roles = Role::get();
        return view('user.create', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //insert into users () values()
        $validate = $request->validate([
            'name'=> 'required', 
            'email' => 'required|email|unique:users,email',  
            'password' => 'required|min:6'
        ]);
        
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name, 
                'email' => $request->email, 
                'password' => $request->password,
            ]);

            $user->roles()->sync($request->role_ids);
            DB::commit();

            Alert::success('Success!', 'Create User Success');
            return redirect()->to('user'); 
        } catch (\Throwable $th) {
            return $th->getMessage();
            DB::rollBack(); 
            Alert::error('Fail!', 'An error occured while saving the user');
            return back()->withInput(); 
        }

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
        $roles = Role::get();
        return view('user.edit', compact('title', 'edit', 'roles'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = [
                'name' => $request->name, 
                'email' => $request->email, 
            ];   
            if(filled($request->password)){
                $data['password'] = $request->password; 
            }

            $user = User::find($id);
            $user->update($data);
            $user->roles()->sync($request->role_ids); 
            Alert::success('Success!', 'Update user successfully'); 
            return redirect()->to('user'); 
        } catch (\Throwable $e) {
            DB::rollBack(); 
            Alert::error('Fail!', 'Update failed!'); 
            return back()->withInput(); 
        }

        //jika user memasukan password

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id); 
        $user->delete();
        Alert::success('Success!', 'Delete user success');
        return redirect()->to('user'); 
    }
}
