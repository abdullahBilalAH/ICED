@extends('layouts.app')


@section('content')
                <!-- Begin Page Content -->
                <div class="col-md-6">
                    <a type="button" class="btn btn-primary btn-lg" href="{{route('categorie.index')}}">
                        Create Category
                    </a>
                </div>                <!-- /.container-fluid -->
                <hr/>
                <br/>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Visibility</th>
                                <th>Description</th>
                                <th>Last_used_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Visibility</th>
                                <th>Description</th>
                                <th>Last_used_at</th>
                                <th>Action</th>

                            </tr>
                        </tfoot>
                        <tbody>
    
                            @foreach ($categories as $categorie)
                            <tr>
                                <td>{{ $categorie['id'] }}</td>
                                <td>{{ $categorie['name'] }}</td>
                                <td>{{ $categorie['slug'] }}</td>
                                <td>{{ $categorie['visibility'] }}</td>
                                <td>{{ $categorie['description'] }}</td>
                                <td>{{ $categorie['last_used_at'] }}</td>
                                <td>
                                    <form method="POST" action="{{route("categorie.destroy",$categorie['id'])}}">
                                        @csrf
                                        @method("delete")
                                    <button type="submit" class="btn btn-primary" role="button" aria-disabled="true">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        
    
                        </tbody>
                    </table>
                </div>
@endsection
