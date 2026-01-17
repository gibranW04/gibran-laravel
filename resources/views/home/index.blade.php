@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- ================= HERO SECTION ================= --}}
    <div class="relative bg-gradient-to-r from-red-700 to-black rounded-2xl p-10 mb-12 text-white overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-wide">
                MANCHESTER UNITED STORE
            </h1>
            <p class="mt-3 text-lg text-red-100 max-w-xl">
                Official merchandise & apparel Manchester United.
                Glory Glory Man United!
            </p>
        </div>

        {{-- Decorative --}}
        <div class="absolute right-0 top-0 opacity-10 text-[180px] font-black select-none">
            MU
        </div>
    </div>

    {{-- ================= FILTER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">
        <h2 class="text-2xl font-bold text-gray-800">
            Produk Terbaru
        </h2>

        <form method="GET">
            <select
                name="category"
                onchange="this.form.submit()"
                class="border border-gray-300 rounded-xl px-5 py-3 text-gray-700 focus:ring-2 focus:ring-red-600 focus:outline-none"
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

                @foreach ($products as $product)
                <a href="{{ route('product.show', $product->slug) }}"
                   class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition">

                    {{-- Image --}}
                    <div class="relative h-56 bg-gray-100 overflow-hidden">
                        <img
                            src="{{ asset('storage/' . ($product->images->first()->image ?? '')) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                        >

                        {{-- Category Badge --}}
                        <span class="absolute top-3 left-3 bg-red-600 text-white text-xs px-3 py-1 rounded-full">
                            {{ $product->category->name ?? 'MU' }}
                        </span>
                    </div>

                    {{-- Content --}}
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-800 line-clamp-2">
                            {{ $product->name }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            Mulai dari
                        </p>

                        <p class="text-xl font-extrabold text-red-600 mt-1">
                            Rp {{ number_format($product->variants->min('price')) }}
                        </p>

                        <div class="mt-4">
                            <span class="inline-block text-sm font-medium text-white bg-black px-4 py-2 rounded-lg">
                                Lihat Produk
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        @else
            <div class="text-center py-24">
                <p class="text-gray-500 text-lg">
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
