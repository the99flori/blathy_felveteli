<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Felvételi - Bláthy</title>
    <link rel="icon" href="{{ asset('assets/img/logos/blathy_icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}">
</head>

<body class="bg-gradient-light">
<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
    <div class="container-fluid"><img src="{{ asset('assets/img/logos/blathy_felirat.png') }}" style="min-width: 100px;max-width: 15%;"><a class="navbar-brand d-none d-md-inline">- Felvételi tájékoztató felület</a>
        <ul class="navbar-nav flex-nowrap ml-auto">
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item"><a href="{{ route('logout') }}" class="btn btn-secondary btn-icon-split" role="button"><span class="text-white text">Kilépés</span><span class="text-white-50 icon"><i class="fas fa-sign-out-alt"></i></span></a></li>
        </ul>
    </div>
</nav>
<div class="container" style="max-width: 750px;">

    <div class="card shadow my-5 border-left-success">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto align-self-center"><i class="fa fa-file-text bg-success border rounded-circle shadow" style="color: var(--white);padding: 10px;font-size: 20px;"></i></div>
                <div class="col align-self-center">
                    <p class="text-success d-inline m-0 font-weight-bold">Jelentkezés</p>
                </div>
            </div>
        </div>
        <div class="card-body" style="padding-bottom: 5px;">
            <p class="text-center card-text">Az alábbi tanuló jelentkezése beérkezett az intézményünkben:</p>
            <div class="table-responsive table-borderless text-left">
                <table class="table table-bordered table-sm">
                    <tbody>
                    <tr>
                        <th style="width: 30%;">Név:</th>
                        <td>{{$student->name}}</td>
                    </tr>
                    <tr>
                        <th>Születési hely, idő:</th>
                        <td>{{$student->bornPlace}}, {{date("Y.m.d.", strtotime($student->bornDate))}}</td>
                    </tr>
                    <tr>
                        <th>Oktatási azonosító:</th>
                        <td>{{$student->eduId}}</td>
                    </tr>
                    @isset($student->primarySchool)
                    <tr>
                        <th>Általános iskola:</th>
                        <td> {{$student->primarySchool->name}}</td>
                    </tr>
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            <p class="text-center" style="margin-bottom: 0px;">A következő tanulmányi terület(ek)re jelentkezett:<br></p>
            <div class="custom-control custom-control-inline custom-switch"><input class="custom-control-input" type="checkbox" id="0023" @if(($student->n23)==true) checked="" @endif disabled=""><label class="custom-control-label" for="mathExam">0023</label></div>
            <div class="custom-control custom-control-inline custom-switch"><input class="custom-control-input" type="checkbox" id="0025" @if(($student->n25)==true) checked="" @endif disabled=""><label class="custom-control-label" for="hunExam">0025</label></div>
        </div>
    </div>
    <div class="card shadow my-5 border-left-primary">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto align-self-center"><i class="fas fa-comments bg-primary border rounded-circle shadow" style="padding: 10px;font-size: 20px;color: var(--white);"></i></div>
                <div class="col align-self-center">
                    <p class="text-primary d-inline m-0 fw-bold"><strong>Szóbeli beosztás</strong></p>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($student->meeting == NULL)
            <p class="lead text-center text-uppercase card-text"><strong>Beosztása folyamatban!</strong><br /></p>
            @elseif ($student->meeting->panel != NULL)
            <p class="text-center card-text">A szóbelivel kapcsolatban a következő információkat közöljük:<br /></p>
            <div class="table-responsive text-start">
                <table class="table table-sm table-borderless">
                    <tbody>
                    <tr>
                        <th style="width: 30%;">Helyszín:</th>
                        <td>BMSZC Bláthy Ottó Titusz Informatikai Technikum<br /><em>1032 Budapest, Bécsi út 134.</em></td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Időpont:</th>
                        <td>{{date("Y.m.d. H:i", strtotime($student->meeting->datetime))}}</td>
                    </tr>
                    <tr>
                        <th>Terem:</th>
                        <td>{{$student->meeting->panel->room}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            @elseif($student->meeting->note=="NemMIN")
                <p class="text-justify card-text">Az általános iskolai eredmények és a központi írásbeli eredmények alapján <strong class="text-danger">nem érte el a felvételi tájékoztatóban meghatározott minimum szintet.</strong> Szóbeli felvételire nem kerül behívásra.</p>
            @elseif($student->meeting->note=="NemMAX")
                <p class="text-justify card-text">Gratulálunk! Az általános iskolai eredmények és a központi írásbeli eredmények alapján mentesül a szóbeli felvételi alól. A szóbeli felvételi vizsgarészre a <strong class="text-success">maximális 25 pont</strong> kerül beszámításra.</p>
        @endif
        </div>
        <div class="card-footer text-center">
            <p class="text-center" style="margin-bottom: 0px;">Probléma vagy kérdés esetén írjon e-mailt a <a class="text-danger" href="mailto:felveteli@blathy.info"><strong>felveteli@blathy.info</strong></a> címre!</p>
        </div>
    </div>

</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/bs-init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
</body>
</html>

