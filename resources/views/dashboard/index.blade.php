@extends('dashboard.layout')

@section('title', 'Adminisztrációs központ')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0">Adminisztrációs központ</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <a class="text-decoration-none" href="{{route('dashboard.studentlog')}}">
            <div class="card shadow border-left-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase font-weight-bold text-xs mb-1"><span>Jelentkező<br>sikeres lekérdezés</span></div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $success }}/{{ $all }} fő</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-cloud-download-alt fa-2x"></i></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row">
    @foreach(auth()->user()->panels as $mypanel)
    <div class="col-md-6 col-xl-3 mb-4"><a class="text-decoration-none text-success" href="{{route('dashboard.panels.index', $mypanel->id)}}">
            <div class="card shadow border-left-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase font-weight-bold text-xs mb-1"><span class="text-uppercase">Bizottságom</span></div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>{{$mypanel->room}}</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users fa-2x"></i></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection
