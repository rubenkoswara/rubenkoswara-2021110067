@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ringkasan Profil') }}</div>

                <div class="card-body text-center">
                    <!-- Foto Profil -->
                    <div class="mb-4">
                        @if ($user->profile_photo_path)
                            <img src="{{ asset('storage/' . str_replace('public/', '', $user->profile_photo_path)) }}" alt="Foto Profil" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <!-- Placeholder image or icon when no photo is uploaded -->
                            
                        @endif
                    </div>

                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y') : '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</p>
                    <p><strong>Nomor Telepon:</strong> {{ $user->no_telepon ?? '-' }}</p>
                    <p><strong>Posisi Jabatan:</strong> {{ $user->posisi_jabatan ?? '-' }}</p>

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
