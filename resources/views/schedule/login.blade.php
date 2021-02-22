<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <form method="POST" action="{{route('schedule.index')}}">
        @csrf
        <div class="form-group row">
            <label class="col-4 col-form-label" for="eduId">Oktatási azonosító:</label>
            <div class="col-8">
                <input id="eduId" name="eduId" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="born" class="col-4 col-form-label">Születési dátum:</label>
            <div class="col-8">
                <input id="born" name="born" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="sign" class="col-4 col-form-label">Jelige:</label>
            <div class="col-8">
                <input id="sign" name="sign" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

</form>

</body>
</html>
