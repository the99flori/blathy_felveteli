<!DOCTYPE html>
<html>
<head>
    <title>Import Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body>

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="importof">Import of:</label>
                <select id="importof" name="importof">
                    <option value="students">students</option>
                    <option value="results">results</option>
                </select>
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Data</button>
                {{-- <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a> --}}
            </form>
        </div>
    </div>
</div>

</body>
</html>
