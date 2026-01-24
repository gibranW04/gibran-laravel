@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-900 via-red-700 to-black dark:bg-gradient-to-br dark:from-slate-900 dark:via-blue-900 dark:to-black">
    <div class="max-w-7xl mx-auto px-4 py-10">

        {{-- ================= HERO SECTION ================= --}}
        <div class="relative bg-gradient-to-r from-red-700 to-black dark:from-blue-700 dark:to-gray-900 rounded-2xl p-10 mb-12 text-white overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-wide">
                    MANCHESTER UNITED STORE
                </h1>
                <p class="mt-3 text-lg text-red-100 dark:text-blue-100 max-w-xl">
                    Official merchandise & apparel Manchester United. Biasakan pakai KING.
                    Glory Glory Man United!!!
                </p>
            </div>

            {{-- Decorative --}}
            <div class="absolute right-0 top-0 opacity-10 text-[180px] font-black select-none">
                MU
            </div>
        </div>

        {{-- ================= FILTER ================= --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">
            <h2 class="text-2xl font-bold text-white">
                Produk Terbaru
            </h2>

            <form method="GET">
                <select
                    name="category"
                    onchange="this.form.submit()"
                    class="border border-gray-300 dark:border-gray-600 rounded-xl px-5 py-3 text-gray-700 dark:text-gray-300 dark:bg-gray-800 focus:ring-2 focus:ring-red-600 focus:outline-none"
                >
                    <option value="">🔴 Semua Kategori</option>
                    @isset($categories)
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->slug }}"
                                {{ request('category') == $category->slug ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    @endisset
                </select>
            </form>
        </div>

        {{-- ================= PRODUCT GRID ================= --}}
        @isset($products)
            @if ($products->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

                    @forelse ($products as $product)
                        <a href="{{ route('product.show', $product->slug) }}"
                            class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition">

        {{-- IMAGE WRAPPER --}}
                 <div class="relative h-56 bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                 <img
                src="{{ $product->image
                    ? asset($product->image)
                    : asset('images/no-image.png') }}"
                class="h-full object-contain transition-transform group-hover:scale-105"
                alt="{{ $product->name }}">

            {{-- CATEGORY BADGE --}}
            <span class="absolute top-3 left-3 bg-red-600 dark:bg-blue-600 text-white text-xs px-3 py-1 rounded-full">
                {{ $product->category->name ?? 'MU' }}
            </span>
        </div>

        {{-- CONTENT --}}
        <div class="p-5">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white line-clamp-2">
                {{ $product->name }}
            </h3>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                Mulai dari
            </p>

            <p class="text-xl font-extrabold text-red-600 dark:text-blue-500 mt-1">
                Rp {{ number_format($product->variants->min('price')) }}
            </p>

            <div class="mt-4">
                <span class="inline-block text-sm font-medium text-white bg-black dark:bg-blue-800 px-4 py-2 rounded-lg">
                    Lihat Produk
                </span>
            </div>
        </div>
    </a>
    @empty
    @endforelse


                </div>
        @else
            <div class="text-center py-24">
                <p class="text-gray-500 dark:text-gray-400 text-lg">
                    Produk belum tersedia
                </p>
            </div>
        @endif

        {{-- ================= PAGINATION ================= --}}
        <div class="mt-12">
            {{ $products->withQueryString()->links() }}
        </div>
    @endisset

</div>
@endsection
