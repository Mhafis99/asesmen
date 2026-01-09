@extends('layouts.app')

@section('title', 'Guru Dashboard')

@section('content')
<div class="mb-4">
    <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
    <p class="text-muted">Dashboard Pembimbing</p>
</div>

@if($jadwalBimbingan->isEmpty() && $jadwalLab->isEmpty())
    <div class="alert alert-info">
        <i class="bi bi-info-circle me-2"></i>
        Anda belum memiliki jadwal bimbingan atau lab. Hubungi admin untuk membuat jadwal.
    </div>
@endif

@if(!$jadwalBimbingan->isEmpty())
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">
                <i class="bi bi-calendar3 me-2"></i>Jadwal Bimbingan Hari Ini
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Kelas</th>
                            <th>Materi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalBimbingan as $jadwal)
                        <tr>
                            <td>{{ $jadwal->tanggal->format('d F Y') }}</td>
                            <td>
                                {{ $jadwal->waktu_mulai->format('H:i') }} -
                                {{ $jadwal->waktu_selesai->format('H:i') }}
                            </td>
                            <td>{{ $jadwal->kelas->nama_kelas }}</td>
                            <td>{{ $jadwal->materi ?? '-' }}</td>
                            <td>
                                @if($jadwal->absensi->where('siswa_id', auth()->id())->count() === 0)
                                    <button class="btn btn-sm btn-success">Absen</button>
                                @else
                                    <span class="badge bg-secondary">Sudah Absen</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@if(!$jadwalLab->isEmpty())
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">
                <i class="bi bi-calendar-check me-2"></i>Jadwal Lab
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Kelas</th>
                            <th>Materi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalLab as $jadwal)
                        <tr>
                            <td>{{ $jadwal->tanggal->format('d F Y') }}</td>
                            <td>
                                {{ $jadwal->waktu_mulai->format('H:i') }} -
                                {{ $jadwal->waktu_selesai->format('H:i') }}
                            </td>
                            <td>{{ $jadwal->kelas->nama_kelas }}</td>
                            <td>{{ $jadwal->materi ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Statistik Siswa</h5>
            </div>
            <div class="card-body">
                <h3>{{ $totalSiswa }}</h3>
                <p class="text-muted">Total Siswa di sekolah</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Kelola Jadwal</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('guru.jadwal-bimbingan') }}" class="btn btn-primary">
                        <i class="bi bi-calendar3 me-2"></i>Jadwal Bimbingan
                    </a>
                    <a href="{{ route('guru.jadwal-lab') }}" class="btn btn-secondary">
                        <i class="bi bi-calendar-check me-2"></i>Jadwal Lab
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
