@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <h1>Edit Product</h1>

    <form method="POST" action="{{ route('admin.products.update', $product) }}">
        @csrf
        @method('PUT')

        <label>Kategori</label><br>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label>Nama</label><br>
        <input type="text" name="name" value="{{ $product->name }}">
        <br><br>

        <label>Harga</label><br>
        <input type="number" name="price" value="{{ $product->price }}">
        <br><br>

        <label>Deskripsi</label><br>
        <textarea name="description">{{ $product->description }}</textarea>
        <br><br>

        <button type="submit">Update</button>
    </form>
@endsection
