<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sambutan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="p-4 bg-white shadow-lg rounded">
        <h2 class="text-center mb-4 fw-bold">SAMBUTAN KEPALA YAYASAN</h2>

        <div class="text-center fw-bold" style="margin-top: 150px; margin-bottom: 150px;">
            <a href="{{ route('admin.sambutan.index') }}" class="btn "target="_top">
                Edit Sambutan
            </a>
        </div>
    </div>
</body>
</html>
