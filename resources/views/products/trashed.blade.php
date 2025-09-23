@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Tong Sampah Produk</h1>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Produk</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trashedProducts as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>
                        <form action="{{ route('products.restore', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin memulihkan produk ini?');">Pulihkan</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada produk yang dihapus.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection