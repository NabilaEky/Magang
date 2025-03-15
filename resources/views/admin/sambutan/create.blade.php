@extends('layouts.admin')

@section('content')
    <style>
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
                <a class="btn text-dark fs-6 px-4 py-1" href="{{ url('/Homepage') }}"
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
    <div class="position-fixed top-50 start-50 translate-middle" style="width: 90%; max-width: 500px;">
        <div class="card p-3 border-0 rounded-4"
            style="background-color: #FFFFFF; box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);">
            <h2 class="text-center mb-3 fw-bold" style=" color: #020202;">Tambah Sambutan
            </h2>

            <form action="{{ route('admin.sambutan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-2">
                    <label for="nama_kepala" class="form-label fw-bold">Nama Kepala Yayasan</label>
                    <input type="text" class="form-control shadow-sm rounded-3" id="nama_kepala" name="nama_kepala"
                        placeholder="Masukkan nama kepala yayasan" required>
                </div>

                <div class="mb-2">
                    <label for="sambutan" class="form-label fw-bold">Isi Sambutan</label>
                    <textarea class="form-control shadow-sm rounded-3" id="sambutan" name="sambutan" rows="4"
                        placeholder="Tulis sambutan di sini..." required></textarea>
                </div>

                <div class="mb-2">
                    <label for="foto_kepala" class="form-label fw-bold">Foto Kepala Yayasan</label>
                    <input type="file" class="form-control shadow-sm rounded-3" id="foto_kepala" name="foto_kepala"
                        accept="image/*">
                    <small class="text-muted">📌 Maks 2MB | Format: jpg, png, jpeg</small>
                    <small class="text-danger" id="gambar-error"></small>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-3">
                    <a href="{{ route('admin.home') }}" class="btn px-3 py-2 shadow fw-bold rounded-2 text-white"
                        style="background-color: #F40000;">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn px-3 py-2 shadow fw-bold rounded-2 text-dark"
                        style="background-color: #F4DC00;">
                        <i class="bi bi-floppy"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById("foto_kepala").addEventListener("change", function () {
            let file = this.files[0];
            let errorMsg = document.getElementById("gambar-error");

            if (file) {
                let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
                let maxSize = 2 * 1024 * 1024; // 2MB

                if (!allowedTypes.includes(file.type)) {
                    errorMsg.textContent = "❌ Format gambar tidak valid! Hanya jpg, jpeg, atau png.";
                    this.value = "";
                } else if (file.size > maxSize) {
                    errorMsg.textContent = "❌ Ukuran gambar terlalu besar! Maksimal 2MB.";
                    this.value = "";
                } else {
                    errorMsg.textContent = "";
                }
            }
        });

        document.querySelector("form").addEventListener("submit", function (event) {
            let errorMsg = document.getElementById("gambar-error").textContent;

            if (errorMsg !== "") {
                Swal.fire({
                    icon: "error",
                    title: "Gagal Menyimpan!",
                    text: "Periksa kembali input gambar sebelum melanjutkan.",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "OK"
                });
                event.preventDefault();
            }
        });
    </script>


@endsection