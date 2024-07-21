<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Page Data</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('pages.save') }}" method="POST">
            @csrf
            @foreach(range(1, 12) as $i)
                <div class="form-group">
                    <label for="page{{ $i }}">Page {{ $i }}:</label>
                    <div class="input-group">
                        <select class="form-control" id="page{{ $i }}" name="page{{ $i }}">
                            <option value="">Select Page</option>
                            @foreach($titles as $title)
                                <option value="{{ $title }}" {{ (old('page' . $i, $pages['page' . $i] ?? '') == $title) ? 'selected' : '' }}>
                                    {{ $title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
