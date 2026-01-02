<h1>Data Product</h1>

<a href="{{ route('admin.products.create') }}">Tambah Product</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    @foreach($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category?->name }}</td>
        <td>{{ $product->price }}</td>
        <td>
            <a href="{{ route('admin.products.edit', $product) }}">Edit</a>

            <form action="{{ route('admin.products.destroy', $product) }}"
                  method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus product?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
