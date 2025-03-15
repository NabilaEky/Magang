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

        .thead-custom {
            background-color: #00583a !important;
            color: white !important;
        }

        .table {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table th,
        .table td {
            border-radius: 5px !important;
        }

        .btn-icon {
            display: flex;
            align-items: center;
        }

        .btn-icon i {
            margin-right: 5px;
        }

        .btn-sm {
            font-size: 14px;
            padding: 6px 12px;
            white-space: nowrap;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .carousel-image {
            width: 100px;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
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
        <h2 class="text-center mb-4 fw-bold" style="font-family: 'Poppins', sans-serif; color: #020202;">Kelola Carousel
        </h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered table-sm">
                <thead class="thead-custom">
                    <tr style="text-align: center;">
                        <th>Slide</th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carousels as $carousel)
                        <tr style="text-align: center;">
                            <td>Slide {{ $carousel->slide_number }}</td>
                            <td>
                                @if($carousel->image_path)
                                    <img src="{{ asset('storage/' . $carousel->image_path) }}" alt="Carousel Slide Image"
                                        class="carousel-image">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.carousel.edit', $carousel->id) }}" class="btn btn-sm fw-bold"
                                    style="background-color: #F4DC00;">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.carousel.destroy', $carousel->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm fw-bold"
                                        style="background-color: #F40000; color: white;">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center gap-3 mb-3">
                <a href="{{ route('admin.home') }}" class="btn fw-bold" style="background-color:#FF9D23; ">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
                <a href="{{ route('admin.carousel.create') }}" class="btn fw-bold" style="background-color:#81E657; ">
                    <i class="bi bi-plus-lg"></i> Tambah Slide
                </a>
            </div>
        </div>
    </div>
@endsection