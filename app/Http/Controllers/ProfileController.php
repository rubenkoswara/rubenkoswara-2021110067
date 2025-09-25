<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
        public function index()
        {
            $user = Auth::user();
            return view('profile.index', compact('user'));
        }

        public function edit()
        {
            $user = Auth::user(); // Ambil data pengguna yang sedang login
            return view('profile.edit', compact('user')); // Kirim variabel $user ke view
        }

        public function update(Request $request)
        {
            $user = Auth::user();

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'tanggal_lahir' => 'nullable|date',
                'alamat' => 'nullable|string|max:255',
                'no_telepon' => 'nullable|string|max:15',
                'posisi_jabatan' => 'nullable|string|max:255',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->alamat = $request->alamat;
            $user->no_telepon = $request->no_telepon;
            $user->posisi_jabatan = $request->posisi_jabatan;

            // Validasi dan update Password (jika diisi)
            if ($request->filled('current_password') || $request->filled('new_password')) {
                $request->validate([
                    'current_password' => 'required|current_password',
                    'new_password' => 'required|min:8|confirmed',
                ]);

                $user->password = Hash::make($request->new_password);
            }

            $user->save();

            return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
        }
}