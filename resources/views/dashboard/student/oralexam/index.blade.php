@extends('dashboard.layout')

@section('title', 'Beosztás lekérdezése')

@section('content')

<h3 class="text-dark mb-4">Beosztás lekérdezése</h3>
<div class="card shadow mb-3">
    <div class="card-body">
        <form action="{{ route('dashboard.student.oralexam.request') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col">
                    <div class="form-group"><label for="eduid" style="font-size: 14px;"><strong>Oktatási azonosító</strong></label><span class="text-danger float-right" style="padding-right: 5px;font-size: 14px;">Kötelező!</span><input class="form-control border-danger" type="text" id="eduid" placeholder="7XXXXXXXXXX" name="eduid"></div>
                </div>
            </div>
            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Lekérdezés</button></div>
        </form>
    </div>
</div>

@endsection
