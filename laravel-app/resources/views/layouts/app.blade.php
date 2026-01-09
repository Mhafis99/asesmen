<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Uji Kompetensi Keahlian')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 10px 15px;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        .sidebar .nav-link.active {
            background-color: #0d6efd;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    @if(auth()->check())
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-2 sidebar">
                    <div class="d-flex flex-column p-3 text-white">
                        <h4 class="mb-4 text-center">UKK APP</h4>
                        <ul class="nav flex-column mb-auto">
                            @if(auth()->user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                                        <i class="bi bi-people me-2"></i>Users
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin.kelas*') ? 'active' : '' }}" href="{{ route('admin.kelas') }}">
                                        <i class="bi bi-building me-2"></i>Kelas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin.jadwal-bimbingan*') ? 'active' : '' }}" href="{{ route('admin.jadwal-bimbingan') }}">
                                        <i class="bi bi-calendar3 me-2"></i>Jadwal Bimbingan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin.jadwal-lab*') ? 'active' : '' }}" href="{{ route('admin.jadwal-lab') }}">
                                        <i class="bi bi-calendar-check me-2"></i>Jadwal Lab
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin.absensi') ? 'active' : '' }}" href="{{ route('admin.absensi') }}">
                                        <i class="bi bi-clipboard-check me-2"></i>Absensi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin.nilai') ? 'active' : '' }}" href="{{ route('admin.nilai') }}">
                                        <i class="bi bi-journal-check me-2"></i>Nilai
                                    </a>
                                </li>
                            @elseif(auth()->user()->isGuru())
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('guru.dashboard') ? 'active' : '' }}" href="{{ route('guru.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('guru.jadwal-bimbingan*') ? 'active' : '' }}" href="{{ route('guru.jadwal-bimbingan') }}">
                                        <i class="bi bi-calendar3 me-2"></i>Jadwal Bimbingan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('guru.jadwal-lab*') ? 'active' : '' }}" href="{{ route('guru.jadwal-lab') }}">
                                        <i class="bi bi-calendar-check me-2"></i>Jadwal Lab
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('guru.absensi') ? 'active' : '' }}" href="{{ route('guru.absensi') }}">
                                        <i class="bi bi-clipboard-check me-2"></i>Absensi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('guru.nilai*') ? 'active' : '' }}" href="{{ route('guru.nilai') }}">
                                        <i class="bi bi-journal-check me-2"></i>Nilai
                                    </a>
                                </li>
                            @elseif(auth()->user()->role === 'siswa')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('siswa.dashboard') ? 'active' : '' }}" href="{{ route('siswa.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('siswa.jadwal-bimbingan') ? 'active' : '' }}" href="{{ route('siswa.jadwal-bimbingan') }}">
                                        <i class="bi bi-calendar3 me-2"></i>Jadwal Bimbingan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('siswa.jadwal-lab') ? 'active' : '' }}" href="{{ route('siswa.jadwal-lab') }}">
                                        <i class="bi bi-calendar-check me-2"></i>Jadwal Lab
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('siswa.nilai') ? 'active' : '' }}" href="{{ route('siswa.nilai') }}">
                                        <i class="bi bi-journal-check me-2"></i>Nilai
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('siswa.profile') ? 'active' : '' }}" href="{{ route('siswa.profile') }}">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <hr>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-2"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu text-small shadow">
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><hr class="dropdown-divider"></li></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Sign out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-10 main-content p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    @else
        @yield('content')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
