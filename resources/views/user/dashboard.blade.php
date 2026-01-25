@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-900 via-red-700 to-black dark:bg-gradient-to-br dark:from-slate-900 dark:via-blue-900 dark:to-black py-10">
    <div class="max-w-7xl mx-auto px-4">
        {{-- HEADER --}}
        <div class="mb-10">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg border-l-4 border-red-600 dark:border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                            Selamat Datang, {{ auth()->user()->name }}! 👋
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">
                            Kelola akun dan pesanan Anda di sini
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 dark:bg-blue-600 dark:hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- QUICK STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            {{-- TOTAL ORDERS --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Pesanan</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">0</p>
                    </div>
                    <div class="bg-red-100 dark:bg-red-900/30 p-4 rounded-full">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- PENDING ORDERS --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Pesanan Diproses</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">0</p>
                    </div>
                    <div class="bg-yellow-100 dark:bg-yellow-900/30 p-4 rounded-full">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- COMPLETED ORDERS --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Pesanan Selesai</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">0</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900/30 p-4 rounded-full">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- MENU GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- PROFILE --}}
            <a href="#" class="group bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition border-2 border-transparent hover:border-red-600 dark:hover:border-blue-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-red-100 dark:bg-red-900/30 p-4 rounded-full group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 dark:group-hover:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Profil Saya</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Lihat dan ubah informasi profil Anda</p>
            </a>

            {{-- ADDRESSES --}}
            <a href="{{ route('addresses.index') }}" class="group bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition border-2 border-transparent hover:border-red-600 dark:hover:border-blue-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-4 rounded-full group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 dark:group-hover:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Alamat Pengiriman</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Kelola alamat pengiriman Anda</p>
            </a>

            {{-- ORDERS --}}
            <a href="#" class="group bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition border-2 border-transparent hover:border-red-600 dark:hover:border-blue-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-4 rounded-full group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 dark:group-hover:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Pesanan Saya</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Lihat riwayat pesanan Anda</p>
            </a>

            {{-- WISHLIST --}}
            <a href="#" class="group bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition border-2 border-transparent hover:border-red-600 dark:hover:border-blue-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-pink-100 dark:bg-pink-900/30 p-4 rounded-full group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 dark:group-hover:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Wishlist</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Item favorit yang Anda inginkan</p>
            </a>

            {{-- REVIEWS --}}
            <a href="#" class="group bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition border-2 border-transparent hover:border-red-600 dark:hover:border-blue-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-yellow-100 dark:bg-yellow-900/30 p-4 rounded-full group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 dark:group-hover:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Review & Rating</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Beri ulasan produk yang sudah dibeli</p>
            </a>

            {{-- SETTINGS --}}
            <a href="#" class="group bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition border-2 border-transparent hover:border-red-600 dark:hover:border-blue-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-green-100 dark:bg-green-900/30 p-4 rounded-full group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 dark:group-hover:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Pengaturan</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Kelola pengaturan akun Anda</p>
            </a>
        </div>

        {{-- BACK TO HOME --}}
        <div class="mt-10 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center bg-white dark:bg-gray-900 text-gray-900 dark:text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
