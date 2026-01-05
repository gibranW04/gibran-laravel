@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <h1>Edit Category</h1>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')

        <label>Nama</label><br>
        <input type="text" name="name" value="{{ $category->name }}">
        <br><br>

        <button type="submit">Update</button>
    </form>
@endsection
