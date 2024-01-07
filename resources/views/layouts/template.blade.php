<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekapitulasi Keterlambatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@500&family=Comfortaa:wght@700&family=Fredoka&family=Poppins:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-o3udr686Eyk5nfg1PJvZ5k8PzByBCH3TKSdcm1Jl3FU9brdVd5cRRd3l7Us9lVpg" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    {{-- <link rel="stylesheet" href="../fontawesome/css/all.min.css"> --}}
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.0.0/uicons-bold-straight/css/uicons-bold-straight.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <style>
        body{
            background-color: #ecf6ff;
            font-family: 'Fredoka', sans-serif;
            color: rgb(21, 21, 109);
        }
    </style>
</head>
    <nav class="navbar navbar-light bg-white shadow bottom-0 p-3 bg-body rounded">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 ">Rekam Keterlambatan <i class="fi fi-br-menu-burger"></i></span>
            @if (Auth::check())
            <div class="dropdown pb-4">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">                            
                    <span class="d-none d-sm-inline mb-0"><i class="fi fi-sr-user" style="margin-right:10px;"></i>{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">Sign out</a>
                    </li>
                </ul>
            </div>
            @endif 
        </div>
        
    </nav>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">                  
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        @if (Auth::check())
                            @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link align-middle px-0" style="font-size: 25px;">
                                <i class="fs-4 bi-house"></i><a href="{{ route('home.page') }}" style="text-decoration:none; color:rgb(21, 21, 109);"><span class="ms-1 d-none d-sm-inline">Dashboard</span></a>
                            </a>
                        </li>
                        <br>
                                <li>
                                    <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                        <span class="ms-1 d-none d-sm-inline"  style="color:rgb(21, 21, 109);">Data Master</span>
                                    </a>
                                    <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu" style="list-style:circle;" >
                                        <li class="w-100">
                                            <a href="{{ route('rayon.home') }}" class="nav-link px-0"> <span class=" ms-4 d-none d-sm-inline">Data Rayon</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('rombel.home') }}" class="nav-link px-0"> <span class="ms-4 d-none d-sm-inline">Data Rombel</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('students.home') }}" class="nav-link px-0"> <span class="ms-4 d-none d-sm-inline">Data Siswa</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.home') }}" class="nav-link px-0"> <span class="ms-4 d-none d-sm-inline">Data User</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 align-middle">
                                    <a href="{{ route('lates.data') }}" class="nav-link px-0"><span class="ms-1 d-none d-sm-inline"  style="color:rgb(21, 21, 109);">Data Keterlambatan</span></a>
                                </li>   
                                @else
                                <li class="nav-item">
                                    <a href="#" class="nav-link align-middle px-0" style="font-size: 25px;">
                                        <i class="fs-4 bi-house"></i><a href="{{ route('home.page') }}" style="text-decoration:none; color:rgb(21, 21, 109);"><span class="ms-1 d-none d-sm-inline">Dashboard</span></a>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 align-middle">
                                    <a href="{{ route('ps.students.home') }}" class="nav-link px-0"> <span class="ms-1 d-none d-sm-inline"  style="color:rgb(21, 21, 109);">Data Siswa</span></a>
                                </li>  
                                <li>
                                    <a href="#" class="nav-link px-0 align-middle">
                                    <a href="{{ route('ps.lates.home') }}" class="nav-link px-0"><span class="ms-1 d-none d-sm-inline"  style="color:rgb(21, 21, 109);">Data Keterlambatan</span></a>
                                </li>
                            @endif  
                        @endif           
                    </ul>
                    <hr>
                    {{-- <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">                            
                            <span class="d-none d-sm-inline mx-1">Administrator</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">Sign out</a>
                            </li>
                        
                        </ul>
                    </div> --}}
                </div>
            </div>
            <div class="col py-3">
                @yield('content')
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('script')
</body>

</html>
</body>

</html>
