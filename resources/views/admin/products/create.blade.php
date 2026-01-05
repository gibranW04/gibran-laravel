@extends('layouts.app')

@section('title', 'Tambah Product')

@section('content')
    <h1>Tambah Product</h1>

    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf

        <label>Kategori</label><br>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label>Nama</label><br>
        <input type="text" name="name">
        <br><br>

        <label>Harga</label><br>
        <input type="number" name="price">
        <br><br>

        <label>Deskripsi</label><br>
        <textarea name="description"></textarea>
        <br><br>

        <button type="submit">Simpan</button>
    </form>
@endsection
