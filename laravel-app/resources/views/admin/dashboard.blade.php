@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-4">
    <h2>Selamat Datang, Admin!</h2>
    <p class="text-muted">Ringkasan Sistem Manajemen Uji Kompetensi Keahlian</p>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Total Siswa</h5>
                <i class="bi bi-people fs-3"></i>
            </div>
            <div class="card-body">
                <h3 class="display-4">{{ $totalSiswa }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Total Guru</h5>
                <i class="bi bi-person-badge fs-3"></i>
            </div>
            <div class="card-body">
                <h3 class="display-4">{{ $totalGuru }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Total Kelas</h5>
                <i class="bi bi-building fs-3"></i>
            </div>
            <div class="card-body">
                <h3 class="display-4">{{ $totalKelas }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Total Jadwal</h5>
                <i class="bi bi-calendar-event fs-3"></i>
            </div>
            <div class="card-body">
                <h3 class="display-4">{{ $totalJadwal }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Menu Cepat</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary w-100">
                            <i class="bi bi-people me-2"></i>Manajemen User
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.kelas') }}" class="btn btn-success w-100">
                            <i class="bi bi-building me-2"></i>Manajemen Kelas
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.jadwal-bimbingan') }}" class="btn btn-info w-100">
                            <i class="bi bi-calendar3 me-2"></i>Jadwal Bimbingan
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.jadwal-lab') }}" class="btn btn-warning w-100">
                            <i class="bi bi-calendar-check me-2"></i>Jadwal Lab
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
