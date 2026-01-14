@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 to-indigo-700">
    <div class="bg-white p-10 rounded-xl shadow-lg text-center max-w-xl">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">
            Selamat Datang 👋
        </h1>

        <p class="text-gray-600 mb-6">
            Ini adalah aplikasi Laravel sederhana dengan autentikasi, dashboard, dan CRUD.
        </p>

        <div class="flex justify-center gap-4">
            <a href="/login"
               class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Login
            </a>

            <a href="/register"
               class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                Register
            </a>
        </div>
    </div>
</div>
@endsection
