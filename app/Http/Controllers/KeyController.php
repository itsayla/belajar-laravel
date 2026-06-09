<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Key;
use RealRashid\SweetAlert\Facades\Alert;


class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = Key::latest()->get();
        $title = "Key Management";
        return view('key.index', compact('keys', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Key";
        return view('key.create', compact('title'));
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

        Key::create($request->all());
        Alert::success('Success', 'Created key succesfully');
        // toast('Success', 'Congrats', 'top-right');
        return redirect()->to('key');
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
        $title = "Edit Key";
        $edit = Key::find($id);
        return view('key.edit', compact('title', 'edit'));
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

        Key::find($id)->update($data);
        return redirect()->to('key');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Key::find($id)->delete();
        return redirect()->to('key');
    }
}