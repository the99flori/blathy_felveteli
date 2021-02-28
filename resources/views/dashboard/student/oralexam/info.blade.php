@extends('dashboard.layout')

@section('title', 'Beosztás lekérdezése')

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Beosztás lekérdezése</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('dashboard.student.oralexam.index') }}"><i class="fas fa-redo fa-sm text-white-50" style="padding-right: 5px;"></i>Új lekérdezés</a>
    </div>
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Lekérdezés eredménye</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-uppercase" colspan="2" style="border-style: none;border-bottom-style: solid;color: var(--dark);">Tanulói adatok</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th style="width: 25%;">Név:</th>
                        <td>{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <th>Oktatási azonosító:</th>
                        <td>{{ $student->eduId }}</td>
                    </tr>
                    <tr>
                        <th>Születési idő:</th>
                        <td>{{ $student->born }}</td>
                    </tr>
                    <tr>
                        <th>Jelige:</th>
                        <td>{{ strtoupper($student->sign) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-uppercase" colspan="2" style="border-style: none;border-bottom-style: solid;color: var(--dark);">beosztás adatai</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($student->meeting == NULL)
                    <tr>
                        <td class="" colspan="2">Még nem került beosztásra!</td>
                    </tr>
                    @elseif ($student->meeting->panel != NULL)
                    <tr>
                        <th style="width: 25%;">Terem:</th>
                        <td>{{ $student->meeting->panel->room }}</td>
                    </tr>
                    <tr>
                        <th>Időpont:</th>
                        <td>{{ $student->meeting->datetime }}</td>
                    </tr>
                    @else
                    <tr>
                        <th style="width: 25%;">Megjegyzés:</th>
                        <td>{{ $student->meeting->note }}</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
