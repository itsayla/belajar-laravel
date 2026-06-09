<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Student;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('major')->orderByDesc('id')->get();
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

        Student::create($request->all());
        Alert::success('Success', 'Created student succesfully');
        // toast('Success', 'Congrats', 'top-right');
        return redirect()->to('student');
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
    public function update(Request $request, string $id)
    {
        $data = [
            'major_id' => $request->major_id,
            'name' => $request->name,
            'phone' => $request->phone,
        ];

        Student::find($id)->update($data);
        Alert::success('Success', 'Update student succesfully');
        return redirect()->to('student');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Student::find($id)->delete();
        Alert::success('Success', 'Delete student succesfully');
        return redirect()->to('student');
    }
}