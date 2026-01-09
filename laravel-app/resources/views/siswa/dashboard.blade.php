@extends('layouts.app')

@section('title', 'Siswa Dashboard')

@section('content')
<div class="mb-4">
    <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
    <p class="text-muted">Dashboard Siswa</p>
</div>

@if(empty($kelasSiswa))
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle me-2"></i>
        Anda belum terdaftar di kelas manapun. Silakan hubungi admin.
    </div>
@endif

@if(!empty($kelasSiswa))
    @if($jadwalBimbingan->isEmpty() && $jadwalLab->isEmpty())
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            Jadwal bimbingan atau lab belum tersedia untuk kelas Anda.
        </div>
    @endif

    @if(!$jadwalBimbingan->isEmpty())
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-calendar3 me-2"></i>Jadwal Bimbingan
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Guru</th>
                                <th>Materi</th>
                                <th>Kehadiran</th>
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
                                <td>{{ $jadwal->guru->name }}</td>
                                <td>{{ $jadwal->materi ?? '-' }}</td>
                                <td>
                                    @if($jadwal->absensi->firstWhere('siswa_id', auth()->id()))
                                        <span class="badge bg-success">Hadir</span>
                                    @else
                                        <span class="badge bg-secondary">Belum Absen</span>
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
                                <th>Guru</th>
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
                                <td>{{ $jadwal->guru->name }}</td>
                                <td>{{ $jadwal->materi ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @if(!$nilaiSiswa->isEmpty())
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-journal-check me-2"></i>Nilai Saya
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal Penilaian</th>
                                <th>Jadwal</th>
                                <th>Nilai Kompetensi</th>
                                <th>Nilai Sikap</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nilaiSiswa as $nilai)
                            <tr>
                                <td>{{ $nilai->tanggal_penilaian?->format('d F Y') ?? '-' }}</td>
                                <td>{{ $nilai->jadwalBimbingan->materi ?? '-' }}</td>
                                <td>
                                    <span class="badge @if($nilai->nilai_kompetensi >= 70) bg-success @elseif($nilai->nilai_kompetensi >= 50) bg-warning @else bg-danger @endif">
                                        {{ $nilai->nilai_kompetensi ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge @if($nilai->nilai_sikap >= 70) bg-success @elseif($nilai->nilai_sikap >= 50) bg-warning @else bg-danger @endif">
                                        {{ $nilai->nilai_sikap ?? '-' }}
                                    </span>
                                </td>
                                <td>{{ $nilai->catatan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endif
@endsection
