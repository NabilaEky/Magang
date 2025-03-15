@extends('layouts.admin')

@section('content')
    <style>
        .navbar {
            padding-left: 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999;
            background-color: #00583A !important;
        }

        .navbar .nav-link,
        .navbar .navbar-brand,
        .navbar .navbar-toggler-icon {
            color: white !important;
        }

        .navbar .nav-link:hover {
            color: #F4DC00 !important;
        }

        .dropdown-menu {
            background-color: #00583a !important;
            border: none;
        }

        .dropdown-item {
            color: white !important;
        }

        .dropdown-item:hover {
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

        .content-wrapper {
            padding-top: 5px;
        }

        .card-custom {
            border-radius: 15px;
            overflow: hidden;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            max-width: 800px;
            margin: 0 auto;
        }

        .card-header-custom {
            background-color: #00583A !important;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            font-size: 1.2rem;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top px-5">
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
                        <a class="nav-link mx-3 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><b>PROGRAM PILIHAN</b></a>
                        <ul class="dropdown-menu">
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

    <div class="content-wrapper d-flex align-items-center justify-content-center min-vh-100">
        <div class="card card-custom shadow-lg">
            <div class="card-header card-header-custom">Tambah Slide</div>
            <div class="card-body">
                {{-- @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif --}}

                <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Slide (1-3)</label>
                        <select name="slide_number" class="form-select shadow-sm" required>
                            @for($i = 1; $i <= 3; $i++)
                                @if(\App\Models\Carousel::isSlideAvailable($i))
                                    <option value="{{ $i }}">Slide {{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Gambar</label>
                        <input type="file" name="image" class="form-control shadow-sm" accept="image/*" required>
                        <small class="text-muted">📌 Hanya file: jpg, png, jpeg, gif (max 2MB)</small>
                        <small class="text-danger" id="image-error"></small>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('admin.carousel.index') }}" class="btn text-white fw-bold px-3 py-2"
                            style="background-color: #F40000;"><i class="bi bi-arrow-left-circle"></i> Kembali</a>
                        <button type="submit" class="btn fw-bold px-3 py-2"
                            style="background-color: #F4DC00; color: #020202;">
                            <i class="bi bi-floppy"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection