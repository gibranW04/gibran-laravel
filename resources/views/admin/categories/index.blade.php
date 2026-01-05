@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <h1>Data Category</h1>

    <a href="{{ route('admin.categories.create') }}">Tambah Category</a>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <tr>
            <th>Nama</th>
            <th>Slug</th>
            <th>Aksi</th>
        </tr>

        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category) }}">Edit</a>

                    <form action="{{ route('admin.categories.destroy', $category) }}"
                          method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus category?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
