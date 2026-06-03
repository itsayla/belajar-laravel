<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function index()
    {
        // laravel index : akan diload di awal 
        return view('latihan'); 
    }

    public function tambah()
    {
        $jumlah = 0;
        $title = 'penjumlahan';
        return view('tambah', compact('jumlah', 'title'));
    }

    public function actionTambah(Request $request)
    {
        $angka1 = $request->angka_1; 
        $angka2 = $request->input('angka_2');

        $jumlah = $angka1 + $angka2; 
        return view('tambah', compact('jumlah')); 
    }

    public function kurang()
    {
        $kurang = 0;
        $title = 'pengurangan';
        return view('kurang', compact('kurang', 'title')); 
    }
    public function actionKurang(Request $request)
    {
        $angka1 = $request->angka_1; 
        $angka2 = $request->input('angka_2');

        $kurang = $angka1 - $angka2; 
        return view('kurang', compact('kurang')); 
    }

    public function kali()
    {
        $kali = 0;
        $title = 'perkalian';
        return view('kali', compact('kali', 'title'));
    }
    public function actionKali(Request $request)
    {
        $angka1 = $request->angka_1; 
        $angka2 = $request->input('angka_2');

        $kali = $angka1 * $angka2; 
        return view('kali', compact('kali')); 
    }

    public function bagi()
    {
        $bagi = 0;
        $title = 'pembagian';
        return view('bagi', compact('bagi', 'title')); 
    }
    public function actionBagi(Request $request)
    {
        $angka1 = $request->angka_1; 
        $angka2 = $request->input('angka_2');

        $bagi = $angka1 / $angka2; 
        return view('bagi', compact('bagi')); 
    }
}
