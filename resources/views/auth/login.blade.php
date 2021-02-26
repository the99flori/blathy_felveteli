<form action="{{route('login.local')}}" method="post">
    @csrf
    Email: <input type="email" name="email"/> Password: <input type="password" name="password"/> <input type="submit"/>

    @error('account')
        Error: {{$message}}
    @enderror
</form>
