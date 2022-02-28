@extends('dashboard.layout')

@section('title', 'Bizottságok')

@section('content')
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Bizottságok</h3>
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table table-hover my-0" id="dataTable">
                        <thead class="table-light">
                        <tr>
                            <th class="justify-content-center">Terem</th>
                            <th class="justify-content-center">Megjegyzés</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($panels as $panel)
                        <tr>
                            <td><a href="{{route('dashboard.panels.index', $panel->id)}}" style="text-decoration: none;"><strong>{{$panel->room}}</strong><br></a></td>
                            <td>{{$panel->note}}</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
