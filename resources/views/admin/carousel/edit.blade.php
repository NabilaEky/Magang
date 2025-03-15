@extends('layouts.admin')

@section('content')
    <style>
        .card {
            margin-bottom: 50px !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2) !important;
        }

        .d-flex.align-items-center.justify-content-center.min-vh-100 {
            padding-bottom: 50px !important;
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

        .navbar .nav-link:hover,
        .nav-link.active {
            color: #F4DC00 !important;
            text-decoration: none;
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

        .content-wrapper {
            padding-top: 80px;
        }

        .card-custom {
            border-radius: 10px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2) !important;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
        }

        .card-header-custom {
            background-color: #00583A !important;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }
    </style>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top px-5">
        <div class="container">
            @if(Auth::check())
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline"
                    onsubmit="return confirmLogout();">
                    @csrf
                    <button type="submit" class="btn logout-btn" title="Logout">
                        <i class="bi bi-box-arrow-left fs-5"></i>
                    </button>
                </form>
            @endif

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
                        <a class="nav-link mx-3 dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <b>PROGRAM PILIHAN</b>
                        </a>
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
    </nav>

    <script>
        function confirmLogout() {
            return confirm("Apakah Anda yakin ingin keluar?");
        }
    </script>

    <div class="content-wrapper">
        <div class="card-header card-header-custom shadow-lg">Edit Slide</div>

        <div class="card shadow-sm p-4">
            <form action="{{ route('admin.carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Slide Number</label>
                    <input type="number" name="slide_number" class="form-control shadow-sm"
                        value="{{ $carousel->slide_number }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Upload Gambar Baru</label>
                    <input type="file" name="image" class="form-control shadow-sm" accept="image/*">
                    <small class="text-muted">📌 Maks 2MB | Format: jpg, png, jpeg, gif</small>
                    <small class="text-danger" id="image-error"></small>
                    @if($carousel->image_path)
                        <div class="mt-3 text-center">
                            <small class="form-text text-muted">🖼 Gambar Saat Ini:</small>
                            <img src="{{ asset('storage/' . $carousel->image_path) }}" width="100%" class="mt-2 rounded">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('admin.carousel.index') }}" class="btn text-white fw-bold"
                        style="background-color: #F40000;"><i class="bi bi-arrow-left-circle"></i> Kembali</a>
                    <button type="submit" class="btn fw-bold" style="background-color: #F4DC00; color: #020202;">
                        <i class="bi bi-floppy"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.querySelector('input[name="image"]').addEventListener('change', function () {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; 
            const errorText = document.getElementById("image-error");
    
            if (file) {
                const fileType = file.type;
     
                if (file.size > maxSize) {
                    errorText.textContent = "❌ Ukuran file terlalu besar! Maksimal 2MB.";
                    this.value = "";
                    return;
                }
    
                if (!['image/jpeg', 'image/png', 'image/jpg'].includes(fileType)) {
                    errorText.textContent = "❌ Hanya format JPG, JPEG, atau PNG yang diperbolehkan.";
                    this.value = "";
                    return;
                }
    
                errorText.textContent = "";
            }
        });
    </script>
    
@endsection