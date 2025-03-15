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
  {{-- Bootstrap link --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>
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
              aria-expanded="false">PROGRAM PILIHAN</a>
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
          style="background-color: #F4DC00; border-radius: 30px;">PPDB</a>
      </div>


      <script>
        function confirmLogout() {
          if (confirm("Apakah Anda yakin ingin keluar?")) {
            document.getElementById('logout-form').submit();
          }
        }
      </script>
  </nav>

  <!-- Carousel Container -->
  <div class="carousel-container position-relative">
    <a href="{{ route('admin.carousel.index') }}" class="btn btn-custom ubah-gambar-btn">
      Ubah Gambar
    </a>
    <div id="carouselExample" class="carousel slide carousel-shadow" data-bs-ride="carousel" data-bs-interval="3000">
      <div class="carousel-inner">
        @if(isset($carouselImages) && $carouselImages->count() > 0)
      @foreach($carouselImages as $image)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
      <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100"
      alt="Slide {{ $loop->iteration }}">
      </div>
    @endforeach
    @else
    <div class="carousel-item active">
      <img src="{{ asset('images/default.jpg') }}" class="d-block w-100" alt="Default Slide">
    </div>
  @endif
      </div>

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

  <!-- Welcome Section -->
  <div class="welcome">
    <h2 class="text-center">SELAMAT DATANG DI WEBSITE YAYASAN NURUL FIRDAUS</h2>
  </div>

  <!-- Container Utama -->
  <div class="content-container">
    <div class="left-container">
      @include('dashboard/adminsambutan')
      @include('dashboard/tentang-kami')
    </div>

    <div class="right-container">
      <iframe class="iframe berita-terkini" src="{{ url('dashboard/berita-terkini') }}"></iframe>
    </div>
  </div>

  <!-- Struktural Section -->
  <div class="w-100 mt-3 p-0" style="background-color: #fff;">
    <div class="row g-0 justify-content-center">
      <div class="col-12">
        <div class="card shadow-lg border-0 text-center m-0 p-0">
          <div class="card-body p-3">
            <h2 class="card-title fw-bold py-3">STRUKTURAL</h2>
            @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
            <a href="{{ route('admin.struktural.index') }}" class="btn mt-5 text-dark fw-bold"
              style="margin-bottom: 200px; background-color: #F4DC00;">
              Ubah Gambar
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Section Berita Detail -->
  <div class="container mt-4">
    <h2 class="text-center fw-bold mb-5 py-3">BERITA</h2>
    <div class="text-center mt-3 mb-4">
      <a href="{{ route('admin.berita.index') }}" class="btn text-dark mt-5 "
        style="background-color: #F4DC00; font-weight: bold; margin-bottom: 200px;">
        Edit Berita
      </a>
    </div>
  </div>

  <!-- Section Hubungi Kami -->
  <div class="container-fluid py-5 shadow-lg mb-3" style="background-color: #fff;">
    <h2 class="text-center fw-bold">HUBUNGI KAMI</h2>
    <div class="row justify-content-center mt-4">
      <div class="col-md-8 text-center">
        <div class="p-4 rounded shadow-sm" style="background-color: #CBD856; font-size: 20px;">
          <p class="mb-0">
            Apabila Anda memiliki pertanyaan atau membutuhkan informasi secara langsung,
            jangan ragu untuk menghubungi kami melalui layanan berikut.
          </p>
        </div>
        <a href="https://wa.me/62XXXXXXXXXX" target="_blank"
          class="btn mt-4 text-white d-inline-flex align-items-center justify-content-center"
          style="background-color: #019965 !important; border-radius: 8px; padding: 12px 24px; font-size: 18px;">
          <i class="fab fa-whatsapp me-2"></i> WhatsApp
        </a>

      </div>
    </div>
  </div>

  <!-- Section Lokasi -->
  <div class="container-fluid py-5" style="background-color: #fff;">
    <h2 class="text-center fw-bold">LOKASI</h2>
    <div class="row justify-content-center align-items-center mt-4">
      <div class="col-md-6">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15839.158466966714!2d110.69193094777198!3d-7.0339961374856355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7095b816b4cafd%3A0x440657b61ffb5e05!2sPondok%20Pesantren%20Nurul%20Firdaus%20Manggarmas!5e0!3m2!1sid!2sid!4v1740491338184!5m2!1sid!2sid"
          width="100%" height="300" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
      <div class="col-md-4 text-center text-md-start mt-4 mt-md-0">
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
          <img src="{{ asset('images/logo-fix.png') }}" alt="Logo Sekolah" width="120" class="mt-2 mx-auto">
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

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>