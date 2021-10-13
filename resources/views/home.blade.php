@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Feedback</h2>
            </div>
            <div class="float-right mb-3">
                @role('user')
                    <a class="btn btn-success" href="{{ route('feedback.create') }}">Feedback <span style="font-size:18px; color: black">&oplus;</span></a>
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
            <th>Name</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($feedbacks as $key => $feedback)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $feedback->title }}</td>
                <td>
                    @if($feedback->status->id == 3)
                        <span style="color:green;font-size: 14px"><b>{{ $feedback->status->title }}</b></span>
                    @elseif($feedback->status->id == 4)
                        <span style="color:red;font-size: 14px"><b>{{ $feedback->status->title }}</b></span>
                    @else
                        <span style="color:royalblue;font-size: 14px"><b>{{ $feedback->status->title }}</b></span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('feedback.show',$feedback->id) }}">Show <span>&#128269;</span></a>
                    @can('edit')
                        <a class="btn btn-primary" href="{{ route('feedback.edit',$feedback->id) }}">Edit <span>&#9997;</span></a>
                    @endcan
                    @can('delete')
                        <form action="{{route('feedback.destroy', $feedback->id)}}" method="POST" style='display:inline'>
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
