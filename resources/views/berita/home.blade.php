<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Berita</title>
  <link rel="icon" href="{{ asset('images/logo-fix.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link href="{{ asset('css/beritastyle.css') }}" rel="stylesheet">
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
            <a class="nav-link text-sm" href="{{ url('/') }}"><b>HOME</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-sm" href="#profile-section"><b>PROFILE</b></a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-sm" href="{{ url('/profil') }}" id="navbarDropdownMenuLink"
              role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

  <!-- Berita -->
  <div class="container border border-dark rounded  p-4"
    style="background-color: #FFF; border-radius: 10px; margin-top: 100px;">
    <h2 class="fw-bold mt-2 mb-3" style="font-size: 20px;">BERITA</h2>
    <div class="text-center mb-4">
      <img src="{{ asset('images/magang.jpg') }}" alt="Image berita" class="img-fluid berita-img">

    </div>
    <hr class="hr-responsive mb-4" style="border: 2px solid #006641; width: 500px; margin: auto;">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      @foreach($berita as $item)
      <div class="col">
      <div class="card shadow-lg border border-dark rounded-4 h-100">
        <img src="{{ Storage::url($item->gambar) }}" class="card-img-top" alt="Gambar Berita">
        <div class="card-body d-flex flex-column">
        <div class="text-center mb-2">
          <span class="badge bg-success">
          {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
          </span>
        </div>
        <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
        @if($item->caption)
      <p class="card-text text-muted flex-grow-1">
        {{ \Illuminate\Support\Str::limit($item->caption, 100, '...') }}
      </p>
    @endif
        <div class="mt-auto text-center">
          <a href="{{ route('admin.berita.show', $item->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
        </div>
        </div>
      </div>
      </div>
    @endforeach

    </div>
  </div>

  </div>
  <a href="{{ route('dashboard.beranda') }}" class="btn btn-outline-success kembali-btn">
    <i class="bi bi-arrow-left-circle"></i> Kembali
  </a>

  @if ($berita instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-4 d-flex justify-content-center">
    {{ $berita->links('pagination::bootstrap-5') }}
    </div>
  @endif

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
          <li><a href="{{ route('dashboard.beranda') }}" class="text-primary text-decoration-underline">Program
              Pilihan</a></li>
          <li><a href="{{ route('dashboard.beranda') }}" class="text-primary text-decoration-underline">Informasi</a>
          </li>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>