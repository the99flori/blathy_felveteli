<a href="{{route('dashboard')}}">Home</a>
<a href="{{route('import')}}">Importálás</a>
<a href="{{route('omschools')}}">OM iskolák lekérése</a>

@auth
    <a href="{{route('dashboard.admin')}}">Admin</a>
@endauth

<a href="{{route('logout')}}">Kilépés</a>
<hr>

@section('content')
        -- Content --
@show
