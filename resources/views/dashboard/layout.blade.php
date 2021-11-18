<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title') - Bláthy</title>
    <link rel="icon" href="{{ asset('assets/img/logos/blathy_icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}">
</head>

<body id="page-top">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-cog"></i></div>
                <div class="sidebar-brand-text mx-3" style="text-align: left;"><span>Bláthy<br>Felvételi</span></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="navbar-nav text-light" id="accordionSidebar">
                @section('sidebar')

                <li class="nav-item"><a class="nav-link @if(Route::currentRouteName() == 'dashboard.index') active @endif" href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i>Adminisztrációs központ</a></li>
                <li class="nav-item"><a class="nav-link @if(Route::currentRouteName() == 'dashboard.import.get') active @endif" href="{{ route('dashboard.import.get') }}"><i class="fas fa-file-upload"></i><span>Tanulói adatok importálása</span></a></li>
                <li class="nav-item"><a class="nav-link @if(strpos(Route::currentRouteName(), 'dashboard.student.oralexam') !== FALSE) active @endif" href="{{ route('dashboard.student.oralexam.index') }}"><i class="fas fa-calendar-alt"></i><span>Beosztás lekérdezése</span></a></li>
                <li class="nav-item"><a class="nav-link {{-- @if(Route::currentRouteName() == 'dashboard.index') active @endif --}}" href="{{-- route('dashboard.school') --}}"><i class="fas fa-university"></i><span>Iskolák lekérdezése</span></a></li>

                @show

            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button><span>{{ Auth::user()->name }} ({{ Auth::user()->email }})</span>
                    <ul class="navbar-nav flex-nowrap ml-auto">
                        <div class="d-none d-sm-block topbar-divider"></div>
                        @section('topbar')

                        <li class="nav-item"><a class="btn btn-secondary btn-icon-split" role="button" href="{{ route('logout') }}"><span class="text-white text">Kilépés</span><span class="text-white-50 icon"><i class="fas fa-sign-out-alt"></i></span></a></li>

                        @show

                    </ul>
                </div>
            </nav>
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span style="line-height: 15px;">Copyright © Bláthy 2021<br>Fejlesztette: Demecs Flórián és Harangozó Zsolt<br></span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/bs-init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
</body>
</html>
