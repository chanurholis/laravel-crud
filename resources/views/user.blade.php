<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h3>Users</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <form class="row g-3 needs-validation" method="GET" accept="{{ route('user') }}">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" id="email" name="email"
                            placeholder="Enter your email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <a href="{{ route('user') }}" class="btn btn-info">Reset</a>
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        @isset($users)
                            @if ($users->count() != 0)
                                @foreach ($users as $key => $value)
                                    <tr>
                                        <td>{{ ($users->currentpage() - 1) * $users->perpage() + $loop->index + 1 }}</td>
                                        <td>{{ $value->name ?? '-' }}</td>
                                        <td>{{ $value->email ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @else 
                            <tr>
                                <td colspan="3" class="text-center">No results found</td>
                            </tr>
                            @endif
                        @endisset
                    </table>
                    @isset($users)
                        @if ($users->count() != 0)
                            {{ $users->withQueryString()->links() }}
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
