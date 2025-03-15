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

        .card-custom {
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .card-header-custom {
            background-color: #00583A;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 1.2rem;
            border-radius: 15px 15px 0 0;
            padding: 15px;
        }

        .form-control-custom {
            border-radius: 10px;
            border: 2px solid #ccc;
            transition: 0.3s ease-in-out;
        }

        .form-control-custom:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
        }

        .btn-custom {
            font-weight: bold;
            border-radius: 8px;
            padding: 10px 25px;
        }

        .img-preview {
            border-radius: 10px;
            border: 3px solid #ddd;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
    <div class="container mt-5 pt-5">
        <div class="card card-custom shadow-lg mb-4">
            <div class="card-header card-header-custom">Edit Gambar Struktural</div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <form action="{{ route('admin.struktural.update', $struktural->id) }}" method="POST"
                    enctype="multipart/form-data" onsubmit="return validateImage()">
                    @csrf
                    @method('PUT')

                    <div class="text-center mb-4">
                        <label class="form-label fw-bold text-secondary">Gambar Saat Ini</label>
                        <div class="d-flex justify-content-center">
                            <img id="currentImage" src="{{ asset('storage/' . $struktural->image_path) }}"
                                class="img-thumbnail img-preview" width="320">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold text-secondary">Pilih Gambar Baru</label>
                        <input type="file" class="form-control form-control-custom" id="image" name="image_path"
                            onchange="previewImage(event)">
                        <small class="text-muted">📌 Maks 2MB | Format: jpg, png, jpeg</small>
                        <small class="text-danger" id="gambar-error"></small>
                        <div class="mt-3 text-center">
                            <img id="newImagePreview" src="" class="img-preview d-none" width="320">
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('admin.struktural.index') }}" class="btn btn-custom text-white" style="background-color: #F40000;; ">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-custom"  style=" background-color: #F4DC00;" >
                            <i class="bi bi-floppy"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            let input = event.target;
            let file = input.files[0];
            let preview = document.getElementById("newImagePreview");
            let error = document.getElementById("gambar-error");
    
            if (!file) {
                error.textContent = "";
                preview.src = "";
                preview.classList.add("d-none");
                return;
            }
    
            let fileSize = file.size / 1024 / 1024; 
            let fileType = file.type;
    
            if (fileSize > 2) {
                error.textContent = "❌ Ukuran file terlalu besar. Maksimal 2MB.";
                input.value = ""; 
                preview.src = "";
                preview.classList.add("d-none");
                return;
            }
    
            if (!['image/jpeg', 'image/png', 'image/jpg'].includes(fileType)) {
                error.textContent = "❌ Hanya format JPG, JPEG, atau PNG yang diperbolehkan.";
                input.value = ""; 
                preview.src = "";
                preview.classList.add("d-none");
                return;
            }
    
            error.textContent = ""; 
            let reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove("d-none");
            };
            reader.readAsDataURL(file);
        }
    
        function validateImage() {
            let input = document.getElementById("image");
            let error = document.getElementById("gambar-error");
            let file = input.files[0];
    
            if (!file) {
                error.textContent = "Silakan pilih gambar terlebih dahulu.";
                error.classList.remove("d-none");
                return false;
            }
    
            let fileSize = file.size / 1024 / 1024; 
            let fileType = file.type;
    
            if (fileSize > 2) {
                error.textContent = "❌ Ukuran file terlalu besar. Maksimal 2MB.";
                error.classList.remove("d-none");
                input.value = ""; 
                return false;
            }
    
            if (!['image/jpeg', 'image/png', 'image/jpg'].includes(fileType)) {
                error.textContent = "❌ Hanya format JPG, JPEG, atau PNG yang diperbolehkan.";
                error.classList.remove("d-none");
                input.value = ""; 
                return false;
            }
    
            error.textContent = "";
            error.classList.add("d-none");
            return true;
        }
    </script>
    
@endsection