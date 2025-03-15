<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Berita Terkini</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .berita-card {
      background: #fff;
      padding: 10px; 
      border-radius: 8px;
      box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-align: center;
    }

    .berita-img {
      width: 100%;
      height: 150px; 
      object-fit: cover;
      border-radius: 8px;
    }

    .berita-title {
      font-size: 14px; 
      font-weight: bold;
      margin-top: 6px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .berita-meta {
      font-size: 11px; 
      color: #777;
      margin-bottom: 3px;
    }

    .berita-deskripsi {
      font-size: 12px; 
      color: #555;
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      word-break: break-word;
    }

    /* Responsiveness */
    @media (max-width: 768px) { 
      .berita-title {
        font-size: 13px;
      }
      .berita-img {
        height: 130px;
      }
    }

    @media (max-width: 576px) { 
      .berita-card {
        padding: 8px;
      }
      .berita-title {
        font-size: 12px;
      }
      .berita-img {
        height: auto;
      }
    }
  </style>
</head>

<body>
  <div class="container mt-4">
    <h2 class="text-center mb-4 fw-bold">BERITA TERKINI</h2>
    <div class="row">
      @forelse($berita->sortByDesc('tanggal')->take(3) as $item) 
        <div class="col-sm-6 col-md-4 mb-3"> 
          <div class="berita-card">
            <img src="{{ asset('storage/'.$item->gambar) }}" alt="Gambar Berita" class="berita-img">
            <p class="berita-title">{{ Str::limit($item->judul, 35) }}</p>
            <p class="berita-meta">
              <strong>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</strong>
              - {{ Str::limit($item->lokasi, 15) }}
            </p>
            <p class="berita-deskripsi">{{ Str::limit($item->caption, 80) }}</p>
          </div>
        </div>
      @empty
        <p class="text-center">Belum ada berita.</p>
      @endforelse
    </div>
  </div>
</body>
</html>
