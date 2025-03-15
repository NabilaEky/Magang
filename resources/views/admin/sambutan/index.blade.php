@extends('layouts.admin')

@section('content')
    <style>
        .custom-rounded {
            border-radius: 40px;
            width: 150px;
            height: auto;
        }

        /* Navbar */
        .navbar {
            padding-left: 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999;
            background-color: #00583A !important;
        }

        .navbar .nav-link {
            color: white;
            font-weight: 500;
            font-size: 1rem;
        }

        .navbar .nav-link,
        .navbar .nav-item.dropdown>a.nav-link {
            color: white !important;
        }

        .navbar .nav-link:hover,
        .navbar .nav-item.dropdown>a.nav-link:hover,
        .nav-link.active {
            color: #F4DC00 !important;
        }

        .dropdown-menu {
            background-color: #00583A !important;
            border: none;
        }

        .dropdown-item {
            color: white !important;
        }

        .dropdown-item:hover {
            background-color: #008b5e !important;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            background-color: #F4DC00 !important;
            color: black !important;
        }

        .logout-btn {
            background-color: transparent !important;
            border: none !important;
            padding: 5px 10px;
        }

        .logout-btn i {
            color: #F4DC00 !important;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
    </style>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top px-5 bg-body-tertiary">
        <div class="container">
            <div class="d-flex align-items-center">
                @if(Auth::check())
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline"
                        onsubmit="confirmLogout(); return false;">
                        @csrf
                        <button type="submit" class="btn logout-btn" title="Logout">
                            <i class="bi bi-box-arrow-left fs-5" style="color: #F4DC00;"></i>
                        </button>
                    </form>
                @endif
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link mx-3 {{ request()->is('admin/home') ? 'active' : '' }}"
                        href="{{ url('admin/home') }}"><b>HOME</b></a>
                    <a class="nav-link mx-3 {{ request()->is('profile-section') ? 'active' : '' }}"
                        href="#profile-section"><b>PROFILE</b></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link mx-3 dropdown-toggle {{ request()->is('profil') ? 'active' : '' }}"
                            href="{{ url('/profil') }}" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"><b>PROGRAM PILIHAN</b></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item {{ request()->is('ma-section') ? 'active' : '' }}"
                                    href="{{ url('ma-section') }}">MA</a></li>
                            <li><a class="dropdown-item {{ request()->is('mts-section') ? 'active' : '' }}"
                                    href="{{ url('mts-section') }}">MTS</a></li>
                        </ul>
                    </li>
                    <a class="nav-link mx-3 {{ request()->is('informasi') ? 'active' : '' }}"
                        href="{{ url('informasi') }}"><b>INFORMASI</b></a>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <a class="btn text-dark fs-6 px-4 py-1 mx-3" href="{{ url('/Homepage') }}"
                    style="background-color: #F4DC00; border-radius: 30px;"><b>PPDB</b></a>
            </div>
        </div>

        <script>
            function confirmLogout() {
                if (confirm("Apakah Anda yakin ingin keluar?")) {
                    document.getElementById('logout-form').submit();
                }
            }
        </script>
    </nav>

    <div class="container mt-5 pt-4">
        <div class="card shadow">
            <div class="card-header text-white text-center" style="background-color: #00583A;">
                <h5 class="m-0">Sambutan</h5>
            </div>
            <div class="card-body text-center">
                @if ($sambutan)
                    <h3 class="fw-bold">{{ $sambutan->nama_kepala }}</h3>
                    <div class="my-3">
                        <img src="{{ optional($sambutan)->foto_kepala ? asset('storage/' . $sambutan->foto_kepala) : 'https://via.placeholder.com/150' }}" 
                            alt="Foto Kepala Sekolah" class="custom-rounded">
                    </div>
                    <p>{{ $sambutan->sambutan }}</p>
                    <div class="mt-4 d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.home') }}" class="btn text-white fw-bold" style="background-color: #F40000;">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                        <a href="{{ route('admin.sambutan.edit', $sambutan->id) }}" class="btn text-dark fw-bold" style="background-color: #F4DC00;">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </div>
                @else
                    <p class="text-muted">Belum ada sambutan yang tersedia.</p>
                @endif
            </div>
        </div>
    </div>
    @endsection
    
