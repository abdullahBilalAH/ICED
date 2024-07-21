@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin...</p>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>user type</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>user type</th>
                            <th>action</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($DB as $user)
                        <tr>
                            <td class="mt-2 text-muted font-weight-bold">{{ $user->id }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['user_type'] }}</td>
                            <td>
                                <form method="POST" action="{{ route('user.destroy', $user['id']) }}">
                                    @csrf
                                    @method("delete")
                                <button type="submit" class="btn btn-primary" role="button" aria-disabled="true">Delete</button>
                                <a href="{{ route('user.edit', $user['id']) }}" class="btn btn-danger" role="button" aria-disabled="true">Admin <==> User</a>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
@endsection
