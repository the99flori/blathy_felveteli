<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Szóbeli beosztás - Bláthy</title>
    <link rel="icon" href="{{ asset('assets/img/logos/blathy_icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}">
</head>

<body class="bg-gradient-light">
<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
    <div class="container-fluid"><img src="{{ asset('assets/img/logos/blathy_felirat.png') }}" style="min-width: 100px;max-width: 15%;"><a class="navbar-brand">- Szóbeli beosztás</a>
        <ul class="navbar-nav flex-nowrap ml-auto">
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item"><a href="{{ route('schedule') }}" class="btn btn-secondary btn-icon-split" role="button"><span class="text-white text">Kilépés</span><span class="text-white-50 icon"><i class="fas fa-sign-out-alt"></i></span></a></li>
        </ul>
    </div>
</nav>
<div class="container" style="max-width: 750px;">
    @if ($student->meeting == NULL)
    <div class="card shadow my-5 border-left-warning">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">{{$student->name}} ({{$student->born}}) - {{$student->eduId}}</p>
        </div>
        <div class="card-body">
            <p class="lead text-center card-text">A szóbeli felvételire még nem került beosztásra!</p>
        </div>
    </div>
    @elseif ($student->meeting->panel != NULL)
    <div class="card shadow my-5 border-left-success">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">{{$student->name}} ({{$student->born}}) - {{$student->eduId}}</p>
        </div>
        <div class="card-body">
            <p class="lead text-center card-text">A szóbeli felvételire a következő időpontban és teremben várjuk!</p>
            <div class="table-responsive table-borderless">
                <table class="table table-bordered">
                    <tbody class="text-uppercase text-success">
                    <tr>
                        <th>Időpont:</th>
                        <td>{{$student->meeting->datetime}}</td>
                    </tr>
                    <tr>
                        <th>Terem:</th>
                        <td>{{$student->meeting->panel->room}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="card shadow my-5 border-left-primary">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">{{$student->name}} ({{$student->born}}) - {{$student->eduId}}</p>
        </div>
        <div class="card-body">
            <p class="lead text-center card-text">{{$student->meeting->note}}</p>
        </div>
    </div>
    @endif
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/bs-init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
</body>
</html>

