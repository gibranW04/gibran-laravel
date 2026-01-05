@extends('layouts.app')

@section('title', 'Tambah Category')

@section('content')
    <h1>Tambah Category</h1>

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <label>Nama</label><br>
        <input type="text" name="name">
        <br><br>

        <button type="submit">Simpan</button>
    </form>
@endsection
