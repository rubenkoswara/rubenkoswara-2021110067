@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profil') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form utama untuk update profil -->
                    <form id="profile-update-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Foto Profil -->
                        <div class="mb-3 text-center">
                            @if ($user->profile_photo_path)
                                <img id="profile-preview" src="{{ asset('storage/' . str_replace('public/', '', $user->profile_photo_path)) }}" alt="Foto Profil" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #ccc; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                            @else
                                <img id="profile-preview" src="https://placehold.co/150x150/f0f0f0/888?text=No+Photo" alt="Foto Profil" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #ccc; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                            @endif
                            <div class="mt-2 d-flex justify-content-center">
                                <label for="profile_photo" class="btn btn-secondary me-2">Ubah Foto Profil</label>
                                <input type="file" id="profile_photo" name="profile_photo" class="d-none">
                                @if ($user->profile_photo_path)
                                    <button type="button" id="delete-photo-btn" class="btn btn-danger">Hapus Foto Profil</button>
                                @endif
                            </div>
                            @error('profile_photo')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- No. Telepon -->
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}">
                            @error('no_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Posisi Jabatan -->
                        <div class="mb-3">
                            <label for="posisi_jabatan" class="form-label">Posisi Jabatan</label>
                            <input type="text" class="form-control @error('posisi_jabatan') is-invalid @enderror" id="posisi_jabatan" name="posisi_jabatan" value="{{ old('posisi_jabatan', $user->posisi_jabatan) }}">
                            @error('posisi_jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr>

                        <!-- Ganti Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini (jika ingin mengubah)</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                            @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-primary">Perbarui Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profilePhotoInput = document.getElementById('profile_photo');
        const profilePreview = document.getElementById('profile-preview');
        const deletePhotoBtn = document.getElementById('delete-photo-btn');

        profilePhotoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Event listener for the delete photo button
        if (deletePhotoBtn) {
            deletePhotoBtn.addEventListener('click', function() {
                // Creates a hidden form and submits a DELETE request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('profile.destroy-photo') }}";
                
                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = "{{ csrf_token() }}";
                form.appendChild(csrfToken);

                // Add method spoofing for DELETE
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                form.appendChild(methodField);
                
                document.body.appendChild(form);
                form.submit();
            });
        }
    });
</script>
@endsection
