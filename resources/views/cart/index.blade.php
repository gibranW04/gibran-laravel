@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-900 via-red-700 to-black dark:bg-gradient-to-br dark:from-slate-900 dark:via-blue-900 dark:to-black py-10">
    <div class="max-w-6xl mx-auto px-4">
        {{-- HEADER --}}
        <div class="mb-10">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg border-l-4 border-red-600 dark:border-blue-500">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">
                    🛒 Keranjang Belanja Anda
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Lihat dan kelola item yang ingin Anda beli
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LIST ITEM --}}
            <div class="lg:col-span-2 space-y-4">
                @forelse ($cart as $item)
                    <div class="bg-white dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 rounded-2xl p-6 flex gap-6 items-center shadow-lg hover:shadow-xl transition hover:border-red-600 dark:hover:border-blue-500">
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-2">{{ $item['product_name'] }}</h3>
                            <p class="text-red-600 dark:text-blue-400 font-semibold text-lg">Rp {{ number_format($item['price']) }}</p>
                        </div>

                        <div class="flex items-center bg-gray-100 dark:bg-gray-800 rounded-xl p-2 border-2 border-gray-300 dark:border-gray-600">
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="hidden" name="variant_id" value="{{ $item['variant_id'] }}">
                                <button name="qty" value="{{ $item['qty'] - 1 }}" class="w-8 h-8 flex items-center justify-center hover:text-red-600 dark:hover:text-blue-400 font-bold">−</button>
                                <span class="w-10 text-center font-bold text-sm dark:text-white">{{ $item['qty'] }}</span>
                                <button name="qty" value="{{ $item['qty'] + 1 }}" class="w-8 h-8 flex items-center justify-center hover:text-red-600 dark:hover:text-blue-400 font-bold">+</button>
                            </form>
                        </div>

                        <div class="text-right min-w-[140px]">
                            <p class="font-bold text-gray-900 dark:text-white text-lg">Rp {{ number_format($item['price'] * $item['qty']) }}</p>
                            <form action="{{ route('cart.remove', $item['variant_id']) }}" method="POST" class="mt-2">
                                @csrf @method('DELETE')
                                <button class="text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 hover:underline font-semibold">Hapus Produk</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-900 p-12 text-center rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-700">
                        <p class="text-gray-600 dark:text-gray-400 text-lg">📦 Keranjang Anda masih kosong</p>
                        <a href="{{ route('home') }}" class="text-red-600 dark:text-blue-400 font-bold mt-4 inline-block hover:underline">
                            ← Mulai Belanja Sekarang
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- SUMMARY & CHECKOUT --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 rounded-2xl p-8 shadow-lg sticky top-6">
                    <h2 class="font-bold text-2xl mb-6 text-gray-900 dark:text-white border-b-2 border-gray-200 dark:border-gray-700 pb-4">
                        📋 Ringkasan Pembayaran
                    </h2>

                    @auth
                        {{-- PILIH ALAMAT --}}
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3 uppercase tracking-wide">
                                📍 Alamat Pengiriman
                            </label>

                            <select id="addressSelector"
                                    class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl shadow-sm
                                           focus:ring-2 focus:ring-red-600 dark:focus:ring-blue-500 focus:border-red-600 dark:focus:border-blue-500
                                           p-3 bg-gray-50 dark:bg-gray-800 text-sm dark:text-white">
                                <option value="">-- Pilih Alamat Tersimpan --</option>
                                @foreach($addresses as $addr)
                                    <option value="{{ $addr->id }}" class="dark:bg-gray-700">
                                        {{ $addr->name }} ({{ $addr->city }})
                                    </option>
                                @endforeach
                            </select>

                            <div class="mt-3">
                                @php
                                    $routeAdd = auth()->user()->hasRole('admin')
                                        ? route('admin.addresses.create')
                                        : route('addresses.create');
                                @endphp

                                <a href="{{ $routeAdd }}"
                                   class="text-sm font-bold text-red-600 dark:text-blue-400 hover:text-red-700 dark:hover:text-blue-300 hover:underline">
                                    + Tambah Alamat Baru
                                </a>
                            </div>
                        </div>

                        {{-- TOTAL --}}
                        <div class="space-y-4 mb-6 bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <div class="flex justify-between text-gray-700 dark:text-gray-300">
                                <span class="font-semibold">Total Barang:</span>
                                <span class="font-bold">{{ collect($cart)->sum('qty') }} pcs</span>
                            </div>

                            <div class="flex justify-between text-2xl font-black text-gray-900 dark:text-white pt-4 border-t-2 border-gray-200 dark:border-gray-700">
                                <span>Total Bayar:</span>
                                <span class="text-red-600 dark:text-blue-400">
                                    Rp {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['qty'])) }}
                                </span>
                            </div>
                        </div>

                        <button id="payButton"
                            class="w-full bg-gradient-to-r from-red-600 to-red-700 dark:from-blue-600 dark:to-blue-700 hover:from-red-700 hover:to-red-800 dark:hover:from-blue-700 dark:hover:to-blue-800
                                   text-white py-4 rounded-xl font-bold text-lg
                                   shadow-lg shadow-red-200 dark:shadow-blue-900 transition-all
                                   active:scale-95 disabled:opacity-50 disabled:shadow-none">
                            💳 Bayar Sekarang
                        </button>

                    @else
                        {{-- GUEST --}}
                        <div class="text-center space-y-4 bg-red-50 dark:bg-red-900/20 p-6 rounded-xl border-2 border-red-200 dark:border-red-700">
                            <p class="text-gray-700 dark:text-gray-300 text-sm font-semibold">
                                🔐 Silakan login untuk melanjutkan checkout
                            </p>

                            <a href="{{ route('login') }}"
                               class="block w-full bg-gradient-to-r from-red-600 to-red-700 dark:from-blue-600 dark:to-blue-700 hover:from-red-700 hover:to-red-800 dark:hover:from-blue-700 dark:hover:to-blue-800
                                      text-white py-4 rounded-xl font-bold text-lg transition-all">
                                Login untuk Checkout
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MIDTRANS SNAP JS --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('services.midtrans.clientKey') }}"></script>

<script>
document.getElementById('payButton')?.addEventListener('click', function (e) {
    e.preventDefault();
    const addressId = document.getElementById('addressSelector').value;

    if (!addressId) {
        alert('Mohon pilih alamat pengiriman terlebih dahulu!');
        return;
    }

    const btn = this;
    btn.innerHTML = `<span class="animate-pulse">⏳ Processing...</span>`;
    btn.disabled = true;

    fetch("{{ route('checkout.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify({
            address_id: addressId
        })
    })
    .then(async res => {
        const data = await res.json();
        if (!res.ok) throw new Error(data.error || 'Server Error');
        return data;
    })
    .then(data => {
        snap.pay(data.snap_token, {
            onSuccess: function(result) {
                alert("Pembayaran Berhasil!");
                window.location.href = '/';
            },
            onPending: function(result) {
                alert("Menunggu pembayaran...");
                location.reload();
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
                btn.innerHTML = "Bayar Sekarang";
                btn.disabled = false;
            },
            onClose: function() {
                btn.innerHTML = "Bayar Sekarang";
                btn.disabled = false;
            }
        });
    })
    .catch(err => {
        alert(err.message);
        btn.innerHTML = "Bayar Sekarang";
        btn.disabled = false;
    });
});
</script>
@endsection
