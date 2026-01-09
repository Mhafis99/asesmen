@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="card shadow-lg" style="max-width: 500px; width: 100%;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <i class="bi bi-person-plus fs-1 text-primary"></i>
                <h3 class="mt-3">Daftar Akun Siswa</h3>
                <p class="text-muted">Uji Kompetensi Keahlian Management</p>
            </div>

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') @enderror" id="username" name="username" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nis" class="form-label">Nomor Induk Siswa (NIS)</label>
                    <input type="text" class="form-control @error('nis') @enderror" id="nis" name="nis" value="{{ old('nis') }}" required>
                    @error('nis')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password_confirmation') @enderror" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100">Daftar</button>

                <div class="text-center mt-4">
                    <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Login disini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
