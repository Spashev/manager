@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Feedback</h2>
            </div>
            <div class="float-right mb-2">
                @role('user')
                @can('create')
                    <a class="btn btn-success" href="{{ route('feedback.create') }}"> Create Feedback</a>
                @endcan
                @endrole
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
            <th>Tema</th>
            <th>Details</th>
            <th>Status</th>
            @role('manager')
            <th>Author</th>
            @endrole
            <th width="280px">Action</th>
        </tr>
        @foreach ($feedback as $item)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->message }}</td>
                <td>
                    @if($item->status->id == 3)
                        <span style="color:green;font-size: 14px"><b>{{ $item->status->title }}</b></span>
                    @elseif($item->status->id == 4)
                        <span style="color:red;font-size: 14px"><b>{{ $item->status->title }}</b></span>
                    @else
                        <span style="color:royalblue;font-size: 14px"><b>{{ $item->status->title }}</b></span>
                    @endif
                </td>
                @role('manager')
                <td>{{ $item->user->name }}</td>
                @endrole
                <td>
                    <form action="{{ route('feedback.destroy',$item->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('feedback.show',$item->id) }}">Show</a>
                        @can('edit')
                            <a class="btn btn-primary" href="{{ route('feedback.edit',$item->id) }}">Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    {!! $feedback->links() !!}


@endsection
