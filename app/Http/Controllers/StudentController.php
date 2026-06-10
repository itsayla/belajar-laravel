<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('major', 'user')->orderByDesc('id')->get();
        $title = "Student Management";
        return view('student.index', compact('students', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Student";
        $majors = Major::get();
        return view('student.create', compact('title', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $validate = $request->validate([
            'major_id' => 'required', 
            'name' => 'required', 
            'phone' => 'nullable'
        ]); 

        DB::beginTransaction(); 
        try {
            // insert user
            $user = User::create([
                'name' => $request->name, 
                'email' => $request->email, 
                'password' => $request->password,
            ]);
            // insert student
            Student::create([
                'name' => $request->name, 
                'user_id' => $user->id,
                'major_id' => $request->major_id
            ]);
            DB::commit(); 
            Alert::success('Success', 'Created student succesfully');
            return redirect()->to('student');
            } catch (\Throwable $th) {
            DB::rollBack(); 
            Alert::error('Fail!', $th->getMessage()); 
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
        $title = "Edit Student";
        $edit = student::find($id);
        $majors = Major::get();
        return view('student.edit', compact('title', 'edit', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        DB::beginTransaction(); 
        try {
            $dataUser = [
                'name' => $request->name, 
                'email' =>$request->email
            ];
            if($request->filled('password')){
                $dataUser['password'] = $request->password; 
            }

            $data = [
                'major_id' => $request->major_id, 
                'name' => $request->name, 
                'phone' => $request->phone, 
            ];
    
            $student->update($data);
            DB::commit();
            Alert::success('Success', 'Update student succesfully');
            return redirect()->to('student');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
            Alert::error('Fail!', $th->getMessage());
            return back()->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        try {
           $student->user->delete();
           Alert::success('Success', 'Delete student succesfully');
           return redirect()->to('student');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Fail!', $th->getMessage());
            return back();
        }
    }
}