@extends('dashboard.layout')

@section('title', 'Tanuló kezelése')

@section('content')

<div class="container-fluid">
    <h3 class="text-dark mb-4">Vizsgajelentkezés áttekintése</h3>
    <div class="row mb-3">
        <div class="col-lg-8 col-xl-6">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
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
                                                <td>{{$student->bornPlace}}, {{$student->bornDate}}</td>
                                            </tr>
                                            <tr>
                                                <th>Oktatási azonosító:</th>
                                                <td>{{$student->eduId}}</td>
                                            </tr>
                                            <tr>
                                                <th>Általános iskola:</th>
                                                <td>{{$student->primarySchool->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Email értesítési cím:</th>
                                                <td>{{$student->email}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary fw-bold m-0">Vizsga adatai</h6>
                </div>
                <div class="card-body text-center">
                    <p class="text-center" style="margin-bottom: 0px;">A következő központi írásbeli vizsgá(k)ra jelentkezett:<br></p>
                    <div class="custom-control custom-control-inline custom-switch"><input class="custom-control-input" type="checkbox" id="hunExam" @if(($student->centralExam->isHun)==true) checked="" @endif disabled=""><label class="custom-control-label" for="hunExam">Magyar nyelv @isset($student->centralExam->hunRoom)({{$student->centralExam->hunRoom}})@endisset </label></div>
                    <div class="custom-control custom-control-inline custom-switch"><input class="custom-control-input" type="checkbox" id="mathExam" @if(($student->centralExam->isMath)==true) checked="" @endif disabled=""><label class="custom-control-label" for="mathExam">Matematika @isset($student->centralExam->mathRoom)({{$student->centralExam->mathRoom}})@endisset </label></div>
                    @if($student->centralExam->isSpecial)<p class="lead text-center text-danger card-text" style="margin-top: 16px;">Speciális kedvezménnyel rendelkezik!<br></p>@endif
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary fw-bold m-0">Dokumentumok</h6>
                </div>
                <div class="card-body text-center">
                    @error('msg')
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Bezár"><span aria-hidden="true">×</span></button>
                        <span style="font-size: 13px;">{{ $message }}</span>
                    </div>
                    @enderror
                    <form action="{{ route('dashboard.student.fileupload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$student->id}}" name="studentid" />
                        <div class="input-group"><select class="form-select d-inline" style="max-width: 250px;" name="type">
                            <option value="special_decree" selected="">Speciális kedvezmény határozat</option>
                            </select><input class="form-control" required="" type="file" name="file"><button class="btn btn-warning" type="submit"><strong>Feltöltés</strong></button></div>
                    </form>
                    @foreach($files as $file)
                        @if($file->type == 'special_decree')
                            <div class="btn-group d-block" role="group" style="margin-top: 16px;"><a class="btn btn-primary" role="button" href="{{route('studentfile', $file->id)}}" style="min-width: 80%;"><strong>Speciális kedvezmény határozat</strong><br></a><a class="btn btn-danger" role="button" href="{{route('dashboard.student.filedelete', $file->id)}}" style="min-width: 20%;"><strong>Törlés</strong></a></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
