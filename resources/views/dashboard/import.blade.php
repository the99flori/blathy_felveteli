@extends('dashboard.layout')

@section('title', 'Tanulói adatok importálása')

@section('content')
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Tanulói adatok importálása</h3>
    </div>
    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('dashboard.import.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col">
                        <div class="form-group"><label for="file" style="font-size: 14px;"><strong>CSV kiválasztása</strong></label><span class="text-danger float-right" style="padding-right: 5px;font-size: 14px;">Kötelező!</span><input class="form-control-file" type="file" id="file" name="file"></div>
                    </div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Importálás</button></div>
            </form>
        </div>
    </div>

@endsection
