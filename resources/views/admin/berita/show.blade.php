<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Berita</title>
  <link rel="icon" href="{{ asset('images/logo-fix.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link href="{{ asset('css/beritastyle.css') }}" rel="stylesheet">
</head>

<body style="background-color: #DCFDF1;">
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
                    <a class="nav-link text-sm" href="{{ url('/') }}"><b>HOME</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-sm" href="#profile-section"><b>PROFILE</b></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-sm" href="{{ url('/profil') }}"
                        id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        PROGRAM PILIHAN
                    </a>
                    <ul class="dropdown-menu custom-dropdown" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item text-sm" href="{{ url('ma-section') }}">MA</a></li>
                        <li><a class="dropdown-item text-sm" href="{{ url('mts-section') }}">MTS</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-sm" href="{{ url('informasi') }}"><b>INFORMASI</b></a>
                </li>
            </ul>

            <div class="d-flex align-items-center ms-auto mt-2 mx-3">
                <a class="btn btn-warning text-white text-sm px-4 py-1 rounded-pill me-3 {{ request()->is('ppdb') ? 'active' : '' }}"
                    href="{{ url('/Homepage') }}"><b>PPDB</b></a>
            </div>
        </div>
    </div>
</nav>


  <div class="container border border-dark rounded  p-4"
    style="background-color: #FFF; border-radius: 10px; margin-top: 100px;">
    <h3 class="text-center fw-bold">{{ $berita->judul }}</h3>
    <p class="text-center text-muted">{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('l, d F Y') }}</p>
    
    @if($berita->gambar)
    <div class="text-center my-4">
        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" 
            class="img-fluid rounded shadow-sm" 
            style="max-width: 100%; height: auto; border-radius: 10px;">
    </div>
    @endif
    
    @if($berita->caption)
    <p class="text-center text-muted"><em>{{ $berita->caption }}</em></p>
    @endif
    
    <p class="mt-3" style="text-align: justify;">{{ $berita->isi }}</p>
    
    <div class="text-center mt-4">
        <a href="{{ route('berita.home') }}" class="btn btn-outline-success">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
    </div>
</div>

  <!-- Sosial Media -->
  <div class="container-fluid py-4">
    <div class="text-center">
      <h5 class="fw-bold text-black mb-4">SOSIAL MEDIA</h5>
      <div class="d-flex justify-content-center gap-3">
        <a href="#" class="social-icon d-flex align-items-center justify-content-center text-white">
          <i class="fab fa-tiktok"></i>
        </a>
        <a href="#" class="social-icon d-flex align-items-center justify-content-center text-white">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="social-icon d-flex align-items-center justify-content-center text-white">
          <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="#" class="social-icon d-flex align-items-center justify-content-center text-white">
          <i class="fab fa-instagram"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="text-center mt-3 mb-5">
    <h5 class="fw-bold" style="color: #006641;">MA NURUL FIRDAUS MANGGARMAS</h5>
  </div>

   <!-- Footer Section -->
   <footer class="container-fluid py-3 px-4 px-md-5 bg-white">
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
              <li><a href="{{ route('dashboard.beranda') }}" class="text-primary text-decoration-underline">Home</a></li>
              <li><a href="{{ route('dashboard.beranda') }}" class="text-primary text-decoration-underline">Profile</a></li>
              <li><a href="{{ route('dashboard.beranda') }}" class="text-primary text-decoration-underline">Program Pilihan</a></li>
              <li><a href="{{ route('dashboard.beranda') }}" class="text-primary text-decoration-underline">Informasi</a></li>
              <li><a href="{{ route('dashboard.beranda') }}" class="text-primary text-decoration-underline">PPDB</a></li>
          </ul>
          
        </div>

        <div class="col-md-2 d-flex flex-column h-100">
            <h5 class="fw-bold mb-3">Website Terkait</h5>
            <ul class="list-unstyled">
                <li><a href="{{ url('ma-section') }}" class="text-primary text-decoration-underline">MA</a></li>
                <li><a href="{{ url('mts-section') }}" class="text-primary text-decoration-underline">MTS</a></li>
            </ul>
        </div>

        <div class="col-md-2 d-flex flex-column h-100">
            <h5 class="fw-bold mb-3">Layanan</h5>
            <ul class="list-unstyled">
                <li><a href="https://wa.me/6285640352942" class="text-primary text-decoration-underline">WhatsApp</a></li>
                <li><a href="mailto:YayasanNufi@gmail.com" class="text-primary text-decoration-underline">Email</a></li>
                <li><a href="{{ url('/Homepage') }}" class="text-primary text-decoration-underline">PPDB</a></li>
            </ul>
        </div>
    </div>

    <hr class="mt-4" style="border-top: 2px solid #000;">

    <div class="text-center py-1">
        <p class="mb-0 text-muted">Copyright © 2025 | Yayasan Nurul Firdaus</p>
        <p class="mb-0 text-muted">Designed by Magang TISI USM</p>
    </div>
</footer>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>