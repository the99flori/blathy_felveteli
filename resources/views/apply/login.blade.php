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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image" style="background-image: url({{ asset('assets/img/art.jpg') }});"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-0">
                                <div class="text-center p-5"><img src="{{ asset('assets/img/logos/blathy_felirat.png') }}" style="width: 100%;">
                                    <h4 class="text-dark mb-4">Felvételi tájékoztató felület</h4>

                                    @error('msg')
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Bezár"><span aria-hidden="true">×</span></button>
                                        <span style="font-size: 13px;">{{ $message }}</span>
                                    </div>
                                    @enderror
                                    @if(true)
                                    <div class="alert alert-warning" role="alert">
                                                        <span style="font-size: 13px;">A jelentkezések feldolgozása a beérkezéstől számított 2 munkanapon belül történik meg!<br><i>Adatok frissítve: {{$updated_at}}</i></span>
                                                    </div>
                                    @endif


                                    <form class="user" method="post" action="{{ route('apply.login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="float-left" for="eduId" style="font-size: 13px;padding-left: 15px;"><strong>Oktatási azonosító</strong></label>
                                            @error('eduId') <small class="text-right text-danger d-block" style="padding-right: 15px;">{{ $message }}</small> @enderror
                                            <input class="form-control form-control-user @error('eduId') border-danger @enderror " type="number" id="eduId" placeholder="7XXXXXXXXXX" name="eduId">
                                        </div>
                                        <div class="form-group">
                                            <label class="float-left" for="born" style="font-size: 13px;padding-left: 15px;"><strong>Születési dátum</strong></label>
                                            @error('born') <small class="text-right text-danger d-block" style="padding-right: 15px;">{{ $message }}</small>@enderror
                                            <input class="form-control form-control-user @error('born') border-danger @enderror " id="born" name="born" type="date" pattern="\d{4}-\d{2}-\d{2}" placeholder="éééé-hh-nn"></div>
                                        <button class="btn btn-primary btn-block text-white btn-user" name="submit" type="submit">Lekérdezés</button>
                                    </form>
                                    <hr>
                                    <h5 class="text-dark">Adminisztrációs felület</h5><a href="{{ route('login') }}" class="btn btn-dark btn-block text-white" role="button"><i class="fab fa-microsoft"></i>&nbsp; Belépés Microsoft 365 fiókkal</a>
                                </div>
                            </div>
                            <a href="#"><i class="fas fa-question-circle float-right" style="padding-bottom: 5px;padding-right: 5px;" data-toggle="modal" data-target="#help"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" tabindex="-1" id="help">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Segítség</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Lekérdezéshez a következő adatokra van szükség:</p>
                <div class="table-responsive table-borderless">
                    <table class="table table-bordered">
                        <thead style="border-bottom-style: solid;">
                        <tr>
                            <th style="border-right-width: 1px;border-right-style: solid;width: 25%;">Mezőnév</th>
                            <th>Várt adat</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr style="border-bottom-width: 1px;border-bottom-style: solid;">
                            <th style="border-right-width: 1px;border-right-style: solid;">Oktatási azonosító</th>
                            <td>11 számjegyből áll, 7-tel kezdődik (megtalálható a diákigazolványon)</td>
                        </tr>
                        <tr style="border-bottom-width: 1px;border-bottom-style: solid;">
                            <th style="border-right-width: 1px;border-right-style: solid;">Születési dátum</th>
                            <td>A tanuló születési ideje</td>
                        </tr>
{{--                        <tr>
                            <th style="border-right-width: 1px;border-right-style: solid;">Jelige</th>
                            <td>A jelentkezési lapon lehetett megadni, amennyiben nem adott meg, akkor hagyja üresen</td>
                        </tr>--}}
                        </tbody>
                    </table>
                </div>
                <p class="text-center">Amennyiben további segítségre van szüksége, írjon a <i><a href="mailto:rendszergazda@blathy.info">rendszergazda@blathy.info</a></i> címre<br>vagy keresse a titkárságot a <i><a href="tel:+3613872111">+36 1 387 2111</a></i>-es telefonszámon.</p>
            </div>
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
