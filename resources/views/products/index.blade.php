@extends('layouts.app')

@section('content')
<h1 class="mb-4">Daftar Produk</h1>
{{-- Tombol untuk navigasi ke halaman tambah produk baru --}}
<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk Baru</a>
{{-- Tombol untuk navigasi ke halaman produk yang dihapus sementara --}}
<a href="{{ route('products.trashed') }}" class="btn btn-info mb-3">Restore</a>

{{-- Menampilkan pesan sukses dari session (contohnya setelah berhasil menambah/mengedit produk) --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Tabel untuk menampilkan daftar produk --}}
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        {{-- Loop untuk menampilkan setiap produk dari database --}}
        @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    {{-- Cek apakah produk memiliki gambar --}}
                    @if ($product->image)
                        {{-- Link yang akan membuka modal saat gambar diklik --}}
                        <a href="#" onclick="openModal(event, '{{ asset('storage/' . $product->image) }}')">
                            {{-- Tampilkan gambar produk dengan ukuran yang seragam dan sudut membulat --}}
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                        </a>
                    @else
                        {{-- Tampilkan gambar placeholder jika tidak ada gambar produk --}}
                        <img src="https://placehold.co/50x50/f0f0f0/888?text=No+Img" alt="No Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    @endif
                </td>
                <td>{{ $product->product_name }}</td>
                <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->description }}</td>
                <td>
                    {{-- Tombol untuk mengedit produk, mengarah ke route 'products.edit' --}}
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    {{-- Form untuk menghapus produk, menggunakan metode DELETE --}}
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            {{-- Tampilkan pesan ini jika tidak ada produk yang ditemukan --}}
            <tr>
                <td colspan="8" class="text-center">Belum ada data produk.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Modal untuk memperbesar gambar -->
<div id="imageModal" class="modal">
    {{-- Tombol untuk menutup modal --}}
    <span class="close" onclick="closeModal()">&times;</span>
    {{-- Elemen gambar di dalam modal --}}
    <img class="modal-content" id="modalImage">
</div>

<style>
/* Styling untuk modal gambar */
.modal {
    display: none; {{-- Modal tersembunyi secara default --}}
    position: fixed; {{-- Posisi tetap di layar --}}
    z-index: 1050; {{-- Z-index tinggi agar tampil di atas elemen lain --}}
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; {{-- Scroll jika kontennya terlalu besar --}}
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.9); {{-- Warna latar belakang semi transparan --}}
}

.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* Animasi saat modal muncul */
.modal-content {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)}
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
}
</style>

<script>
    {{-- Fungsi untuk membuka modal --}}
    function openModal(event, src) {
        event.preventDefault(); {{-- Mencegah link navigasi --}}
        var modal = document.getElementById("imageModal");
        var modalImg = document.getElementById("modalImage");
        modal.style.display = "block";
        modalImg.src = src; {{-- Set sumber gambar modal --}}
    }

    {{-- Fungsi untuk menutup modal --}}
    function closeModal() {
        var modal = document.getElementById("imageModal");
        modal.style.display = "none";
    }

    {{-- Tutup modal saat mengklik di luar gambar --}}
    window.onclick = function(event) {
        var modal = document.getElementById("imageModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
@endsection
