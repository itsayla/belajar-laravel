<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use RealRashid\SweetAlert\Facades\Alert;


class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::latest()->get();
        $title = "Major Management";
        return view('major.index', compact('majors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Major";
        return view('major.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'is_active' => 'required'
        ]);

        Major::create($request->all());
        Alert::success('Success', 'Created major succesfully');
        // toast('Success', 'Congrats', 'top-right');
        return redirect()->to('major');
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
        $title = "Edit Major";
        $edit = major::find($id);
        return view('major.edit', compact('title', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'name' => $request->name,
            'is_active' => $request->is_active
        ];

        Major::find($id)->update($data);
        return redirect()->to('major');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Major::find($id)->delete();
        return redirect()->to('major');
    }
}