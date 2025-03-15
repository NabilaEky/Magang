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
            padding-top: 80px;
        }

        .card-custom {
            border-radius: 10px;
            overflow: hidden;
            border: none;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
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

    <div class="content-wrapper">
        <div class="card card-custom shadow-lg mb-4">
            <div class="card-header card-header-custom">Edit Berita</div>
            <div class="card shadow-sm p-4">
                <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data"
                    onsubmit="return validateForm()">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" value="{{ $berita->judul }}"
                            required>
                        <small class="text-muted">📌 Maks 100 karakter</small>
                        <small class="text-danger" id="judul-error"></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $berita->tanggal }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="gambar">
                        <small class="text-muted">📌 Maks 2MB | Format: jpg, png, jpeg</small>
                        <small class="text-danger" id="gambar-error"></small>
                        @if($berita->gambar)
                            <div class="mt-3 text-center">
                                <small class="form-text text-muted">🖼 Gambar Saat Ini:</small>
                                <img src="{{ asset('storage/' . $berita->gambar) }}" width="100%" class="mt-2 rounded">
                            </div>
                        @else
                            <p class="text-muted mt-2 text-center">⚠️ Tidak ada gambar.</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Caption</label>
                        <input type="text" name="caption" class="form-control" value="{{ $berita->caption }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi</label>
                        <textarea name="isi" class="form-control" rows="5" required>{{ $berita->isi }}</textarea>
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.berita.index') }}" class="btn px-4 text-white fw-bold"
                            style="background-color: #F40000;"><i class="bi bi-arrow-left-circle"></i> Kembali</a>
                        <button type="button" class="btn text-dark fw-bold" style="background-color: #F4DC00;"
                            onclick="clearForm()">
                            <i class="bi bi-eraser-fill" style="color: black;"></i> Clear
                        </button>

                        <button type="submit" class="btn text-white fw-bold" style="background-color: #00583A;"><i
                                class="bi bi-floppy"> </i> Update
                        </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function clearForm() {
            if (confirm("Apakah Anda yakin ingin menghapus semua input?")) {
                let form = document.querySelector("form");
                if (form) {
                    form.reset();
                }

                let gambarInput = document.getElementById("gambar");
                if (gambarInput) {
                    gambarInput.value = "";
                }

                let isiTextarea = document.querySelector("textarea[name='isi']");
                if (isiTextarea) {
                    isiTextarea.value = "";
                }

                let previewImg = document.querySelector("img");
                if (previewImg) {
                    previewImg.src = "https://via.placeholder.com/150";
                }

                document.getElementById("judul-error").innerHTML = "";
                document.getElementById("gambar-error").innerHTML = "";
            }
        }

        document.getElementById("gambar").addEventListener("change", function () {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024;
            const errorText = document.getElementById("gambar-error");

            if (file) {
                const fileType = file.type;

                if (file.size > maxSize) {
                    errorText.textContent = "❌ Ukuran file terlalu besar. Maksimal 2MB.";
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

        document.getElementById("judul").addEventListener("input", function () {
            const judulInput = this;
            const judulError = document.getElementById("judul-error");

            if (judulInput.value.length > 100) {
                judulError.innerText = "❌ Judul tidak boleh lebih dari 100 karakter.";
            } else {
                judulError.innerText = "";
            }
        });
    </script>

@endsection