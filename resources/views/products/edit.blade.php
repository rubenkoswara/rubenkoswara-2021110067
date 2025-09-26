@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Produk</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Gambar Produk -->
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk:</label>
            <br>
            @if ($product->image)
                <img id="image-preview" src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" style="width: 150px; height: 150px; object-fit: cover; border-radius: 5px;">
                <div class="mt-2">
                    <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('delete-image-form').submit();">Hapus Gambar</button>
                </div>
            @else
                <img id="image-preview" src="https://placehold.co/150x150/f0f0f0/888?text=No+Image" alt="No Image" style="width: 150px; height: 150px; object-fit: cover; border-radius: 5px;">
            @endif
            <input type="file" class="form-control mt-3 @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage(event);">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="product_name" class="form-label">Nama Produk:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok:</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori:</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $product->category }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi:</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
    
    <!-- Formulir tersembunyi untuk menghapus gambar -->
    <form id="delete-image-form" action="{{ route('products.destroyImage', $product->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('image-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
