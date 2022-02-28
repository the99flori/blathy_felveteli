@extends('dashboard.layout')

@section('title', 'Adatok importálása')

@section('content')
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Adatok importálása</h3>
    </div>
    <div class="card shadow mb-3">
        <div class="card-body">
            @error('msg')
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Bezár"><span aria-hidden="true">×</span></button>
                <span style="font-size: 13px;">{{ $message }}</span>
            </div>
            @enderror
            <form action="{{ route('dashboard.import.post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <div class="form-group">
                        <label for="file" style="font-size: 14px;"><strong>Importálandó kiválasztása</strong></label><span class="text-danger float-right" style="padding-right: 5px;font-size: 14px;">Kötelező!</span>
                        <div class="form-row">
                            <div class="col-xl-4"><select class="custom-select d-inline" name="importType">
                                    <optgroup label="BLÁTHY">
                                        <option value="CentralExamTapaScheduleTable">Írásbeli beosztás (TAPA)</option>
                                        <option value="OralExamTapaSchedule">Szóbeli beosztás (TAPA)</option>
                                        <option value="PrimaryPointsImport">Hozott eredmények</option>
                                    </optgroup>
                                    <optgroup label="KÖZFELVIR">
                                        <option value="KOZFELVIRapplicants">Vizsgajelentkezők</option>
                                    </optgroup>
                                    <optgroup label="KIFIR">
                                        <option value="KIFIRapplicantsImport" selected>Iskolai jelentkezők</option>
                                    </optgroup>
                                    <optgroup label="DARI">
                                        <option value="primarySchoolsImport">Köznevelési intézmények adatai</option>
                                    </optgroup>
                                </select></div>
                            <div class="col-xl-5 align-self-center"><input class="form-control-file" type="file" required="" id="file" name="file"></div>
                            <div class="col text-right"><button class="btn btn-primary" type="submit">Importálás</button></div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

@endsection
