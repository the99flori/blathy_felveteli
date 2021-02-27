<form action="{{route('login.local')}}" method="post">
    @csrf
    Email @error('email')(Error:{{$message}}):@enderror <input type="email" name="email"/> Password  @error('password')(Error:{{$message}})@enderror: <input type="password" name="password"/> <input type="submit"/>

    @error('account')
        Error: {{$message}}
    @enderror
</form>
