@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="card shadow-lg" style="max-width: 400px; width: 100%;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <i class="bi bi-school fs-1 text-primary"></i>
                <h3 class="mt-3">UKK APP</h3>
                <p class="text-muted">Uji Kompetensi Keahlian Management</p>
            </div>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
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

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                </div>

                <div class="text-center mt-4">
                    <p>Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
