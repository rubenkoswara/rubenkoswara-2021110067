@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ringkasan Profil') }}</div>

                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y') : '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</p>
                    <p><strong>Nomor Telepon:</strong> {{ $user->no_telepon ?? '-' }}</p>
                    <p><strong>Posisi Jabatan:</strong> {{ $user->posisi_jabatan ?? '-' }}</p>

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection