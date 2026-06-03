@extends('main')
@section('content')

    <br><br>
    <form action="{{ route('action-kurang') }}" method="post">
        @csrf
        <label for="">Angka 1</label>
        <input type="text" placeholder="Masukkan Angka" name="angka_1">
        -
        <label for="">Angka 2</label>
        <input type="text" placeholder="Masukkan Angka" name="angka_2">

        <br>
        <br>
        <button type="submit">Proses</button>
    </form>

    <h1>Hasil Perhitungan : {{ $kurang }}</h1>
    @endsection
