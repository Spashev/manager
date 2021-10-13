@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Role Management</h2>
            </div>
            <div class="float-right mb-3">
                @can('create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}">Role <span style="font-size:18px; color: black">&oplus;</span></a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show <span>&#128269;</span></a>
                    @can('edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit <span>&#9997;</span></a>
                    @endcan
                    @can('delete')
                        <form action="{{route('roles.destroy', $role->id)}}" method="POST" style='display:inline'>
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" >Delete &#128465;</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
@endsection
