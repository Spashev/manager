@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="float-right mb-2">
                <a class="btn btn-success" href="{{ route('users.create') }}"> User <span style="font-size:18px; color: black">&oplus;</span></a>
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
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show<span>&#128269;</span></a>
                    @can('edit')
                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit <span>&#9997;</span></a>
                    @endcan
                    @can('delete')
                        <form action="{{route('users.destroy', $user->id)}}" method="POST" style='display:inline'>
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
