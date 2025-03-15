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

        .pagination .page-item.active .page-link {
            background-color: #00583A !important;
            border-color: #00583A !important;
        }

        .pagination .page-link:hover {
            background-color: #00412B !important;
            color: white !important;
        }


        @media (max-width: 992px) {
            .navbar-nav {
                flex-direction: column;
                align-items: start !important;
                gap: 0 !important;
            }

            .navbar-nav a {
                padding: 5px 10px;
            }

            .navbar-nav .dropdown-menu {
                position: static !important;
                width: 100%;
            }
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

    <div class="container mt-5 pt-5">
        <h1 class="text-center text-3xl fw-bold text-dark mb-4"> Kelola Berita</h1>

        <form action="{{ route('admin.berita.index') }}" method="GET" class="d-flex justify-content-center gap-3 mb-4">
            <div class="input-group w-25 shadow-sm">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari berita..."
                    value="{{ request('search') }}">
            </div>

            <div class="input-group w-auto shadow-sm">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <select name="month" class="form-select">
                    <option value=""> Pilih Bulan</option>
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-group w-auto shadow-sm">
                <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                <select name="year" class="form-select">
                    <option value="">Pilih Tahun</option>
                    @foreach(range(date('Y'), date('Y') - 10) as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary shadow-sm px-4">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <div class="table-responsive">
            <table class="table border rounded-4 shadow-sm overflow-hidden">
                <thead class="text-white" style="background-color: #00583a;">
                    <tr style="text-align: center;">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Gambar</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($berita as $index => $item)
                        <tr class="{{ $index % 2 == 0 ? 'bg-light' : 'bg-white' }} hover:bg-green-100 transition-all">
                            <td class="px-4 py-3">{{ $item->id }}</td>
                            <td class="px-4 py-3">{{ $item->judul }}</td>
                            <td class="px-4 py-3">{{ $item->tanggal }}</td>
                            <td class="px-4 py-3">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="rounded shadow-sm" width="100">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm shadow-sm me-2 fw-bold"
                                    style="background-color: #F4DC00; color: #020202; border: none;">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm shadow-sm mt-2 fw-bold"
                                        style="background-color: #F40000; color: white; border: none;"
                                        onclick="return confirm('Yakin ingin menghapus berita ini?');">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $berita->links() }}
            </div>

            <div class="d-flex justify-content-center gap-3 mb-3">
                <a href="{{ url('admin/home') }}" class="btn shadow-sm fw-bold"
                    style="background-color: #FF9D23; color: #020202;">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>

                <a href="{{ route('admin.berita.create') }}" class="btn shadow-sm fw-bold"
                    style="background-color: #81E657; color: #020202;">
                    <i class="bi bi-plus-lg"></i> Tambah Berita
                </a>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(".navbar-toggler").click(function () {
                $("#navbarNavAltMarkup").toggleClass("show");
            });
        });
    </script>
@endsection