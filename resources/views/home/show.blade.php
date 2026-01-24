@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-900 via-red-700 to-black dark:bg-gradient-to-br dark:from-slate-900 dark:via-blue-900 dark:to-black py-10">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- ================= IMAGE GALLERY ================= --}}
            <div>
                <div class="border rounded-xl overflow-hidden shadow-lg bg-white dark:bg-gray-900 flex items-center justify-center p-6">
                    <img
                        id="mainImage"
                        src="{{ $product->image
                            ? asset($product->image)
                            : ($product->images->first()
                                ? asset($product->images->first()->image)
                                : asset('images/no-image.png')) }}"
                        alt="{{ $product->name }}"
                        class="max-h-[420px] object-contain"
                    >
                </div>

                @if ($product->images->count())
                    <div class="flex gap-3 mt-4 overflow-x-auto pb-2">
                        @foreach ($product->images as $image)
                            <img
                                src="{{ asset($image->image) }}"
                                onclick="document.getElementById('mainImage').src = this.src"
                                class="w-20 h-20 object-cover rounded-lg border-2 border-gray-300 hover:border-red-600 dark:border-gray-700 dark:hover:border-blue-500 cursor-pointer transition flex-shrink-0"
                                alt="{{ $product->name }}"
                            >
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ================= PRODUCT INFO ================= --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg">
                <nav class="flex mb-6" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-blue-500">Home</a></li>
                        <li><span class="mx-2 text-gray-400">/</span></li>
                        <li class="text-red-600 dark:text-blue-500 font-semibold">{{ $product->category->name }}</li>
                    </ol>
                </nav>

                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mt-2 mb-4">
                    {{ $product->name }}
                </h1>

                <p class="text-gray-600 dark:text-gray-400 mt-4 leading-relaxed">
                    {{ $product->description }}
                </p>

                {{-- ================= ADD TO CART FORM ================= --}}
                <form action="{{ route('cart.add') }}" method="POST" class="mt-8">
                    @csrf

                    {{-- Data Produk yang dibutuhkan Controller --}}
                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                    {{-- Harga Default (akan diupdate via JS saat pilih variant jika ingin lebih dinamis) --}}
                    <input type="hidden" id="selected_price" name="price" value="{{ $product->variants->min('price') }}">

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                        Pilih Variant & Ukuran
                    </h3>

                    <div class="space-y-3">
                        @foreach ($product->variants as $variant)
                            <label
                                class="group flex items-center justify-between border-2 rounded-xl p-4 cursor-pointer transition
                                {{ $variant->stock == 0 ? 'opacity-50 cursor-not-allowed bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700' : 'border-gray-300 dark:border-gray-700 hover:border-red-600 dark:hover:border-blue-500 hover:bg-red-50 dark:hover:bg-blue-900/20' }}"
                            >
                                <div class="flex items-center gap-4">
                                    <input
                                        type="radio"
                                        name="variant_id"
                                        value="{{ $variant->id }}"
                                        data-price="{{ $variant->price }}"
                                        onclick="document.getElementById('selected_price').value = this.getAttribute('data-price'); document.getElementById('display_price').innerText = 'Rp ' + Number(this.getAttribute('data-price')).toLocaleString()"
                                        class="w-5 h-5 text-red-600 dark:text-blue-600 focus:ring-red-500 dark:focus:ring-blue-500"
                                        {{ $variant->stock == 0 ? 'disabled' : 'required' }}
                                    >

                                    <div>
                                        <p class="font-bold text-gray-800 dark:text-white group-hover:text-red-700 dark:group-hover:text-blue-400">
                                            {{ $variant->color ?? 'Standard' }} {{ $variant->size ? '- Size ' . $variant->size : '' }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 italic">
                                            Sisa Stok: {{ $variant->stock }}
                                        </p>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <p class="font-bold text-gray-900 dark:text-white">
                                        Rp {{ number_format($variant->price) }}
                                    </p>
                                    @if ($variant->stock > 0)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400">
                                            Habis
                                        </span>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>

                    {{-- ================= QUANTITY & PRICE DISPLAY ================= --}}
                    <div class="mt-8 p-6 bg-gradient-to-br from-red-50 to-gray-50 dark:from-red-900/20 dark:to-blue-900/20 rounded-2xl border-2 border-red-200 dark:border-blue-700">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-gray-700 dark:text-gray-300 font-medium">Kuantitas</span>
                            <div class="flex items-center border-2 border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800">
                                <button type="button" onclick="this.nextElementSibling.stepDown()" class="px-3 py-1 hover:text-red-600 dark:hover:text-blue-500 font-bold">−</button>
                                <input type="number" name="qty" value="1" min="1" class="w-12 text-center border-none focus:ring-0 text-sm font-semibold dark:bg-gray-800 dark:text-white">
                                <button type="button" onclick="this.previousElementSibling.stepUp()" class="px-3 py-1 hover:text-red-600 dark:hover:text-blue-500 font-bold">+</button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t-2 border-red-200 dark:border-blue-700">
                            <span class="text-gray-800 dark:text-gray-300 font-bold text-lg">Subtotal</span>
                            <span id="display_price" class="text-3xl font-black text-red-600 dark:text-blue-500">
                                Rp {{ number_format($product->variants->min('price')) }}
                            </span>
                        </div>
                    </div>

                    {{-- ================= ACTION BUTTON ================= --}}
                    <div class="mt-6 flex flex-col sm:flex-row gap-4">
                        <button
                            type="submit"
                            class="flex-1 bg-gradient-to-r from-red-600 to-red-700 dark:from-blue-600 dark:to-blue-700 hover:from-red-700 hover:to-red-800 dark:hover:from-blue-700 dark:hover:to-blue-800 text-white py-4 rounded-xl font-bold text-lg shadow-lg transition-all active:scale-95 disabled:bg-gray-400 disabled:shadow-none"
                            {{ $product->variants->sum('stock') == 0 ? 'disabled' : '' }}>
                            @if($product->variants->sum('stock') == 0)
                                Stok Habis
                            @else
                                🛒 Tambah ke Keranjang
                            @endif
                        </button>

                        <a href="{{ route('home') }}"
                           class="sm:w-32 flex items-center justify-center border-2 border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 py-4 rounded-xl font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                            Batal
                        </a>
                    </div>
                </form>

                <p class="mt-6 text-xs text-center text-gray-500 dark:text-gray-400 italic">
                    * Pastikan Anda telah memilih variant yang benar sebelum menekan tombol tambah.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
