<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YAYASAN NURUL FIRDAUS</title>
    <link rel="icon" href="{{ asset('images/logo-fix.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <!--  Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    {{-- CSS --}}
    <link href="{{ asset('css/style_dashboard.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top navbar-light px-5 shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand me-4" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-fix.png') }}" alt="Nurul Firdaus" width="50">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav justify-content-center w-100 gap-3">
                <li class="nav-item">
                    <a class="nav-link text-sm {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}"><b>HOME</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-sm {{ request()->is('profile-section') ? 'active' : '' }}" href="#profile-section"><b>PROFILE</b></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-sm {{ request()->is('profil') ? 'active' : '' }}" 
                        href="{{ url('/profil') }}" id="navbarDropdownMenuLink" role="button" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                        PROGRAM PILIHAN
                    </a>
                    <ul class="dropdown-menu custom-dropdown" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item text-sm {{ request()->is('ma-section') ? 'active' : '' }}" href="{{ url('ma-section') }}">MA</a></li>
                        <li><a class="dropdown-item text-sm {{ request()->is('mts-section') ? 'active' : '' }}" href="{{ url('mts-section') }}">MTS</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-sm {{ request()->is('informasi') ? 'active' : '' }}" href="{{ url('informasi') }}"><b>INFORMASI</b></a>
                </li>
            </ul>

            <div class="d-flex align-items-center ms-auto mt-2 mx-3">
                <a class="btn btn-warning text-white text-sm px-4 py-1 rounded-pill me-3 {{ request()->is('ppdb') ? 'active' : '' }}" 
                    href="{{ url('/Homepage') }}"><b>PPDB</b></a>

                <a href="{{ url('admin/login') }}" class="btn btn-outline-light login-btn">
                    <i class="bi bi-person-circle login-icon"></i>
                </a>
            </div>

        </div>
    </div>
</nav>


    @php
        use App\Models\Carousel;
        $carouselImages = Carousel::latest()->get(); 
    @endphp

    <!-- Carousel -->
    <div class="carousel-container">
        <div id="carouselExample" class="carousel slide carousel-shadow" data-bs-ride="carousel"
            data-bs-interval="3000">
            <div class="carousel-inner">
                @if($carouselImages->count() > 0)
                    @foreach($carouselImages as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img style="background:rgba(0, 0, 0, 0.4)" src="{{ asset('storage/' . $image->image_path) }}"
                                class="d-block w-100" alt="Slide {{ $image->slide_number }}">
                        </div>
                    @endforeach
                @else
                    <div class="carousel-item active">
                        <img src="{{ asset('images/default-carousel.jpg') }}" class="d-block w-100" alt="Default Slide">
                    </div>
                @endif
            </div>

            <div class="carousel-caption-container">
                <div class="carousel-caption top-caption">
                    <h5 class="yayasan-title">YAYASAN NURUL FIRDAUS</h5>
                </div>
                <div class="carousel-caption bottom-caption">
                    <h5 class="address-text">
                        Jl. Gg. Cendana, RT.02/RW.04, Manggar, Manggarmas, Kec. Godong, Kabupaten Grobogan, Jawa Tengah
                        58162
                    </h5>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="welcome">
        <h2>SELAMAT DATANG DI WEBSITE YAYASAN NURUL FIRDAUS</h2>
    </div>

    <!-- Container Utama -->
    <div class="content-container">
        <div class="left-container">
            @include('dashboard.sambutan')
            @include('dashboard.tentang-kami')
        </div>

        <div class="right-container">
            <iframe class="iframe berita-terkini" src="{{ url('dashboard/berita-terkini') }}"></iframe>
        </div>
    </div>

    @php
        $struktur = \App\Models\Struktural::latest()->first();
    @endphp

    <!-- Struktural Section -->
    <div class="w-100 mt-3 p-0" style="background-color: #fff;">
        <div class="row g-0 justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg border-0 text-center m-0 p-0">
                    <div class="card-body p-3">
                        <h2 class="card-title fw-bold py-3">STRUKTURAL</h2>
                        <div class="text-center mb-4">
                            <img src="{{ $struktur && $struktur->image_path ? asset('storage/' . $struktur->image_path) : asset('images/nurul.jpeg') }}"
                                alt="Struktural" class="img-fluid w-100 rounded shadow-sm"
                                style="max-width: 1200px; height: auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Berita Detail -->
<div class="container mt-5">
    <h2 class="text-center fw-bold mb-4">BERITA</h2>
    <div class="row gx-3 gy-3 justify-content-center"> 
        @forelse($berita->take(4) as $item)
            <div class="col-6 d-flex justify-content-center"> 
                <div class="border border-2 border-secondary rounded p-3 shadow-sm bg-white"
                    style="max-width: 340px; width: 100%;"> 
                    <div class="text-center">
                        <img src="{{ Storage::url($item->gambar) }}" alt="Gambar Berita"
                            class="img-fluid rounded shadow-sm"
                            style="max-height: 170px; width: 100%; object-fit: cover;"> 
                    </div>
                    <div class="mt-2 text-center">
                        <p class="fw-bold mb-1 text-truncate" style="font-size: 14px;">{{ $item->judul }}</p>
                        <p class="text-muted mb-2" style="font-size: 12px;">
                            <strong>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</strong><br>
                            MA Nurul Firdaus, Desa Manggarmas
                        </p>
                        <p class="text-muted berita-deskripsi text-truncate" style="font-size: 12px;">
                            {{ Str::limit($item->caption, 60) }}
                        </p>
                        <a href="{{ route('admin.berita.show', $item->id) }}"
                            class="text-decoration-none fw-bold text-primary" style="font-size: 12px;">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada berita.</p>
        @endforelse
    </div>
    <div class="text-center mt-3 mb-5">
        <a href="/berita/home" class="btn text-white px-4 py-2 rounded shadow-sm"
            style="background-color: #006641; font-weight: bold; font-size: 14px;">Lihat Selengkapnya</a>
    </div>
</div>

    <!-- Hubungi Kami Section -->
    <div class="container-fluid py-5 shadow-lg" style="background-color: #fff;">
        <h2 class="text-center fw-bold">HUBUNGI KAMI</h2>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center">
                <div class="p-4 rounded shadow-sm" style="background-color: #CBD856; font-size: 20px;">
                    <p class="mb-0">
                        Apabila Anda memiliki pertanyaan atau membutuhkan informasi secara langsung,
                        jangan ragu untuk menghubungi kami melalui layanan berikut.
                    </p>
                </div>

                <a href="https://wa.me/6285640352942" target="_blank"
                    class="btn mt-4 text-white d-inline-flex align-items-center justify-content-center"
                    style="background-color: #019965; border-radius: 8px; padding: 12px 24px; font-size: 18px;">
                    <i class="fab fa-whatsapp me-2"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>

    <div class="py-2" style="box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);"></div>

    <div class="container-fluid py-5" style="background-color: #fff;">
        <h2 class="text-center fw-bold">LOKASI</h2>

        <div class="row justify-content-center align-items-center mt-4">
            <div class="col-md-6 px-3">
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15839.158466966714!2d110.69193094777198!3d-7.0339961374856355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7095b816b4cafd%3A0x440657b61ffb5e05!2sPondok%20Pesantren%20Nurul%20Firdaus%20Manggarmas!5e0!3m2!1sid!2sid!4v1740491338184!5m2!1sid!2sid"
                        width="100%" height="300" style="border:0; border-radius: 10px;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="col-md-5 text-center text-md-start mt-4 mt-md-0 px-3">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                    <i class="fas fa-map-marker-alt fa-2x me-2 text-danger"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Pondok Pesantren Nurul Firdaus Manggarmas</h5>
                        <p class="mb-0">Jl. Gg. Cendana, RT.02/RW.04, Manggar, Manggarmas,</p>
                        <p class="mb-0">Kec. Godong, Kabupaten Grobogan, Jawa Tengah 58162</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="container-fluid py-3 px-4 px-md-5">
        <div class="row justify-content-center text-center text-md-start align-items-start h-100 mt-4 pt-3 gap-3">

            <div class="col-md-3 d-flex flex-column h-100 text-center mx-auto">
                <img src="images/logo-fix.png" alt="Logo Sekolah" width="120" class="mt-2 mx-auto">
                <p class="mt-2"><i class="bi bi-envelope me-2"></i> YayasanNufi@gmail.com</p>
                <p><i class="bi bi-telephone me-2"></i> +62 856-4035-2942</p>

                <div class="mt-3">
                    <a href="#" class="me-2"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-tiktok fs-4"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-linkedin fs-4"></i></a>
                </div>
            </div>

            <div class="col-md-2 d-flex flex-column h-100">
                <h5 class="fw-bold mb-3">Navigasi</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('dashboard.beranda') }}" class="text-blue-500 underline">Home</a></li>
                    <li><a href="{{ route('dashboard.beranda') }}" class="text-blue-500 underline">Profile</a></li>
                    <li><a href="{{ route('dashboard.beranda') }}" class="text-blue-500 underline">Program Pilihan</a>
                    </li>
                    <li><a href="{{ route('dashboard.beranda') }}" class="text-blue-500 underline">Informasi</a></li>
                    <li><a href="{{ route('dashboard.beranda') }}" class="text-blue-500 underline">PPDB</a></li>
                </ul>
            </div>

            <div class="col-md-2 d-flex flex-column h-100">
                <h5 class="fw-bold mb-3">Website Terkait</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('dashboard.beranda') }}" class="text-blue-500 underline">MA</a></li>
                    <li><a href="{{ route('dashboard.beranda') }}" class="text-blue-500 underline">MTS</a></li>
                </ul>
            </div>

            <div class="col-md-2 d-flex flex-column h-100">
                <h5 class="fw-bold mb-3">Layanan</h5>
                <ul class="list-unstyled">
                    <li><a href="https://wa.me/6285640352942" class="text-decoration text-blue">WhatsApp</a></li>
                    <li><a href="mailto:YayasanNufi@gmail.com" class="text-decoration text-blue">Email</a></li>
                    <li><a href="{{ route('dashboard.beranda') }}" class="text-blue-500 underline">PPDB</a></li>
                </ul>
            </div>
        </div>

        <hr class="mt-4" style="border-top: 2px solid #000;">

        <div class="text-center py-1">
            <p class="mb-0 text-muted">Copyright © 2025 | Yayasan Nurul Firdaus</p>
            <p class="mb-0 text-muted">Designed by Magang TISI USM</p>
        </div>
    </footer>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Slick Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>