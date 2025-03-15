@extends('layouts.admin')

@section('content')
    <style>
        label {
            font-weight: bold;
            color: black;
        }

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
            <div class="card-header text-white text-center d-flex align-items-center justify-content-center"
                style="background-color: #00583A;">
                <h4 class="m-0">Edit Sambutan</h4>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.sambutan.update', $sambutan->id) }}" method="POST"
                    enctype="multipart/form-data" id="sambutanForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 text-center">
                        <label for="foto_kepala" class="form-label fw-bold">Foto Kepala Yayasan</label><br>
                        @if($sambutan->foto_kepala)
                            <img src="{{ optional($sambutan)->foto_kepala ? asset('storage/' . $sambutan->foto_kepala) : 'https://via.placeholder.com/100' }}"
                                alt="Foto Kepala Sekolah" class="custom-rounded w-15 h-auto">
                        @else
                            <img src="https://via.placeholder.com/150" class="custom-rounded w-15 h-auto" id="previewImg">
                        @endif
                        <input type="file" name="foto_kepala" id="foto_kepala" class="form-control mt-2">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                        <small id="gambar-error" class="text-danger"></small>

                    </div>

                    <div class="mb-3">
                        <label for="nama_kepala" class="form-label">Nama Kepala Yayasan</label>
                        <input type="text" name="nama_kepala" id="nama_kepala" class="form-control" required
                            value="{{ old('nama_kepala', $sambutan->nama_kepala) }}" placeholder="Masukkan Nama">
                    </div>

                    <div class="mb-3">
                        <label for="sambutan" class="form-label">Kalimat Sambutan</label>
                        <textarea name="sambutan" id="sambutan" class="form-control" rows="4" required
                            placeholder="Masukkan Kalimat Sambutan">{{ old('sambutan', $sambutan->sambutan) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.sambutan.index') }}" class="btn text-white fw-bold"
                            style="background-color: #F40000;"><i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                        <button type="button" class="btn text-dark fw-bold" style="background-color: #F4DC00;"
                            onclick="clearForm()">
                            <i class="bi bi-eraser-fill" style="color: black;"></i> Clear
                        </button>

                        <button type="submit" class="btn text-white fw-bold" style="background-color: #00583A;"><i
                                class="bi bi-floppy"> </i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("sambutanForm");
            const namaKepala = document.getElementById("nama_kepala");
            const sambutan = document.getElementById("sambutan");
            const fotoKepala = document.getElementById("foto_kepala");
            const previewImg = document.getElementById("previewImg");
            const errorMsg = document.getElementById("gambar-error");
            const clearButton = document.querySelector("button[onclick='clearForm()']");

            function clearForm() {
                if (confirm("Apakah Anda yakin ingin menghapus semua input?")) {
                    form.reset();
                    namaKepala.value = "";
                    sambutan.value = "";
                    previewImg.src = "https://via.placeholder.com/150";
                    fotoKepala.value = "";
                    errorMsg.innerHTML = "";
                }
            }

            if (fotoKepala) {
                fotoKepala.addEventListener("change", function () {
                    const file = this.files[0];
                    const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
                    const maxSize = 2 * 1024 * 1024;

                    if (file) {
                        if (!allowedTypes.includes(file.type)) {
                            errorMsg.innerHTML = "❌ Hanya format JPG, JPEG, atau PNG yang diperbolehkan.";
                            this.value = "";
                            previewImg.src = "https://via.placeholder.com/150";
                        } else if (file.size > maxSize) {
                            errorMsg.innerHTML = "❌ Ukuran gambar terlalu besar.  Maksimal 2MB.";
                            this.value = "";
                            previewImg.src = "https://via.placeholder.com/150";
                        } else {
                            errorMsg.innerHTML = "";
                            const reader = new FileReader();
                            reader.onload = (e) => (previewImg.src = e.target.result);
                            reader.readAsDataURL(file);
                        }
                    }
                });
            }

            if (form) {
                form.addEventListener("submit", function (event) {
                    if (errorMsg.textContent.trim() !== "") {
                        event.preventDefault();
                        errorMsg.innerHTML = "⚠️ Periksa kembali input gambar sebelum melanjutkan.";
                    }
                });
            }

            if (clearButton) {
                clearButton.addEventListener("click", clearForm);
            }
        });
    </script>

@endsection