@extends('dashboard.layout')

@section('title', 'Tanuló kezelése')

@section('content')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">Tanuló áttekintése</h3>
        <div class="row mb-3">
            <div class="col-md-12 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Tanuló adatai</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive text-start">
                                    <table class="table table-sm table-borderless">
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
                                        <tr>
                                            <th>Általános iskola:</th>
                                            <td>@if(isset($student->primarySchool)) {{$student->primarySchool->name}}@endif - ({{$student->primaryOM}})</td>
                                        </tr>
                                        <tr>
                                            <th>Email értesítési cím:</th>
                                            <td>{{$student->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jelige:</th>
                                            <td>@if(isset($student->sign)) {{$student->sign}} @else nincs megadva @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <p class="text-center" style="margin-bottom: 0px;">A következő tanulmányi terület(ek)re jelentkezett:<br></p>
                        <div class="custom-control custom-control-inline custom-switch"><input class="custom-control-input" type="checkbox" id="0023" @if(($student->n23)==true) checked="" @endif disabled=""><label class="custom-control-label" for="mathExam">0023</label></div>
                        <div class="custom-control custom-control-inline custom-switch"><input class="custom-control-input" type="checkbox" id="0025" @if(($student->n25)==true) checked="" @endif disabled=""><label class="custom-control-label" for="hunExam">0025</label></div>
                    </div>
                </div>
                @if(isset($student->result))
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="text-primary fw-bold m-0">Előzetes felvételi rangsor</h6>
                        </div>
                        <div class="card-body">
                            @if ($student->result->sumpoint == NULL)
                                <p class="lead text-center text-uppercase card-text"><strong>Rangsorolás folyamatban!</strong><br /></p>
                            @elseif ($student->result->sumpoint == "NORAL")
                                <p class="text-justify card-text">Az előzetesen meghirdetett szóbeli meghallgatáson nem vett részt, <strong class="text-danger">a felvételi követelményeket nem teljesítette, ezért nem felvehető!</strong></p>
                            @elseif($student->result->sumpoint != NULL)
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th class="text-uppercase">Összesített eredmény (0-100):</th>
                                            <td>{{$student->result->sumpoint}} pont</td>
                                        </tr>
                                        <tbody>
                                        @isset($student->result->tt0023)
                                            <tr>
                                                <th class="text-uppercase">0023 tanulmányi terület:</th>
                                                @if(is_numeric($student->result->tt0023))
                                                    <td>{{$student->result->tt0023}}. hely a rangsorban</td>
                                                @else
                                                    <td class="text-justify">Az általános iskolai eredmények és a központi írásbeli eredmények alapján <strong class="text-danger">nem érte el a felvételi tájékoztatóban meghatározott minimum szintet.</strong></td>
                                                @endif
                                            </tr>
                                        @endisset
                                        @isset($student->result->tt0025)
                                            <tr>
                                                <th class="text-uppercase">0025 tanulmányi terület:</th>
                                                @if(is_numeric($student->result->tt0025))
                                                    <td>{{$student->result->tt0025}}. hely a rangsorban</td>
                                                @else
                                                    <td class="text-justify">Az előzetesen meghírdetett szóbeli meghallgatáson nem vett részt, <strong class="text-danger">a felvételi követelményeket nem teljesítette!</strong></td>
                                                @endif
                                            </tr>
                                        @endisset
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Szóbeli beosztása</p>
                    </div>
                    <div class="card-body">
                        @if ($student->meeting == NULL)
                            <p class="lead text-center text-uppercase card-text"><strong>Beosztása folyamatban!</strong><br /></p>
                        @elseif ($student->meeting->panel != NULL)
                        @error('msg')
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Bezár"><span aria-hidden="true">×</span></button>
                            <span style="font-size: 13px;">{{ $message }}</span>
                        </div>
                        @enderror
                        @error('info')
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Bezár"><span aria-hidden="true">×</span></button>
                            <span style="font-size: 13px;">{{ $message }}</span>
                        </div>
                        @enderror
                        <form action="{{ route('dashboard.student.oralexam.change') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$student->id}}" name="studentid" />
                            <div class="table-responsive text-start">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                    <tr>
                                        <th>Időpont:</th>
                                        <td><input class="form-control" type="datetime-local" required value="{{date("Y-m-d\TH:i", strtotime($student->meeting->datetime))}}" name="datetime" /></td>
                                    </tr>
                                    <tr>
                                        <th>Terem:</th>
                                        <th><input class="form-control" type="number" required value="{{$student->meeting->panel->room}}" name="room"/></th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="custom-control custom-switch float-left">
                                <input id="changeAccept" type="checkbox" class="custom-control-input" required>
                                <label class="custom-control-label" for="changeAccept"><strong>MÓDOSÍTÁS</strong></label>
                            </div>
                            <button id="save" class="btn btn-primary float-right" type="submit" disabled><strong>Rögzítés</strong></button>
                        </form>
                    @elseif($student->meeting->note=="NemMIN")
                        <p class="text-justify card-text">Az általános iskolai eredmények és a központi írásbeli eredmények alapján <strong class="text-danger">nem érte el a felvételi tájékoztatóban meghatározott minimum szintet.</strong> Szóbeli felvételire nem kerül behívásra.</p>
                    @elseif($student->meeting->note=="NemMAX")
                        <p class="text-justify card-text">Gratulálunk! Az általános iskolai eredmények és a központi írásbeli eredmények alapján mentesül a szóbeli felvételi alól. A szóbeli felvételi vizsgarészre a <strong class="text-success">maximális 25 pont</strong> kerül beszámításra.</p>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                @if(isset($student->centralExam) || isset($student->primaryPoint))
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-primary fw-bold m-0">Hozott eredmények</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-start">
                            <table class="table table-hover">
                                <tbody>
                                @isset($student->centralExam)
                                <tr>
                                    <th class="text-uppercase" colspan="3">Központi írásbeli felvételi vizsga</th>
                                </tr>
                                <tr>
                                    <th>Magyar nyelv:</th>
                                    <td colspan="2"><strong>{{$student->centralExam->hunResult}}</strong> / 50 pont <i>({{$student->centralExam->hunResult/50*100}}%)</i></td>
                                </tr>
                                <tr>
                                    <th>Matematika:</th>
                                    <td colspan="2"><strong>{{$student->centralExam->mathResult}}</strong> / 50 pont <i>({{$student->centralExam->mathResult/50*100}}%)</i></td>
                                </tr>
                                @endisset
                                @isset($student->primaryPoint)
                                <tr>
                                    <th class="text-uppercase" colspan="3">Általános iskolai jegyek</th>
                                </tr>
                                <tr>
                                    <th>Tantárgy</th>
                                    <th>7. évvégi</th>
                                    <th>8. félévi</th>
                                </tr>
                                <tr>
                                    <th>Irodalom:</th>
                                    <td>{{$student->primaryPoint->lit_7 == NULL ? "-" : $student->primaryPoint->lit_7}}</td>
                                    <td>{{$student->primaryPoint->lit_8h == NULL ? "-" : $student->primaryPoint->lit_8h}}</td>
                                </tr>
                                <tr>
                                    <th>Magyar nyelv:</th>
                                    <td>{{$student->primaryPoint->hun_7 == NULL ? "-" : $student->primaryPoint->hun_7}}</td>
                                    <td>{{$student->primaryPoint->hun_8h == NULL ? "-" : $student->primaryPoint->hun_8h}}</td>
                                </tr>
                                <tr>
                                    <th>Matematika:</th>
                                    <td>{{$student->primaryPoint->math_7 == NULL ? "-" : $student->primaryPoint->math_7}}</td>
                                    <td>{{$student->primaryPoint->math_8h == NULL ? "-" : $student->primaryPoint->math_8h}}</td>
                                </tr>
                                <tr>
                                    <th>Történelem:</th>
                                    <td>{{$student->primaryPoint->his_7 == NULL ? "-" : $student->primaryPoint->his_7}}</td>
                                    <td>{{$student->primaryPoint->his_8h == NULL ? "-" : $student->primaryPoint->his_8h}}</td>
                                </tr>
                                <tr>
                                    <th>Idegen nyelv:</th>
                                    <td>{{$student->primaryPoint->flang_7 == NULL ? "-" : $student->primaryPoint->flang_7}}</td>
                                    <td>{{$student->primaryPoint->flang_8h == NULL ? "-" : $student->primaryPoint->flang_8h}}</td>
                                </tr>
                                <tr>
                                    <th>Fizika:</th>
                                    <td>{{$student->primaryPoint->phy_7 == NULL ? "-" : $student->primaryPoint->phy_7}}</td>
                                    <td>{{$student->primaryPoint->phy_8h == NULL ? "-" : $student->primaryPoint->phy_8h}}</td>
                                </tr>
                                @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        checker = document.getElementById('changeAccept');
        checker.onchange = function() {

            if (checker.checked == 1) {
                document.getElementById('save').disabled = false;
            }
            if (checker.checked == 0) {
                document.getElementById('save').disabled = true;
            }
        }
    </script>

@endsection
