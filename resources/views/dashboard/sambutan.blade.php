<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sambutan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style_dashboard.css') }}" rel="stylesheet">
    <style>
        .custom-rounded {
            border-radius: 40px;
            width: 150px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="p-4 bg-white shadow-lg rounded">
        <h2 class="text-center mb-4 fw-bold">SAMBUTAN KEPALA YAYASAN</h2>
        <div class="text-center my-4">
            <img src="{{ optional($sambutan)->foto_kepala ? asset('storage/' . $sambutan->foto_kepala) : 'https://via.placeholder.com/100' }}"
                alt="Foto Kepala Sekolah" class="custom-rounded w-15 h-auto">

        </div>
        <h4 class="text-center fw-bold">
            {{ optional($sambutan)->nama_kepala ?? 'Nama Kepala Yayasan' }}
        </h4>
        <p class="text-center text-muted">Kepala Sekolah</p>
        <p class="text-center">
            {{ optional($sambutan)->sambutan ?? 'Belum ada sambutan yang tersedia.' }}
        </p>
    </div>
</body>

</html>