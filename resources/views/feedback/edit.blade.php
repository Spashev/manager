@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('feedback.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('feedback.update',$feedback->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 offset-3">
                <div class="form-group">
                    @role('user')
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $feedback->title }}" class="form-control" placeholder="Name">
                    @endrole
                    @role('manager')
                    <p>
                        <strong>Name:</strong> {{ $feedback->title }}
                    </p>
                    @endrole
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 offset-3">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="message" placeholder="Detail">{{ $feedback->message }}</textarea>
                </div>
            </div>
            @role('user')
            <div class="col-xs-6 col-sm-6 col-md-6 offset-3">
                <div class="form-group">
                    <strong>File:</strong>
                    <input type="file" name="file" class="form-control" placeholder="Select File">
                </div>
            </div>
            @endrole
            <div class="col-xs-6 col-sm-6 col-md-6 offset-3">
                <div class="form-group">
                    @role('manager')
                        <select class="form-control" aria-label="Default select example" name="status_id">
                            @foreach($statuses as $status)
                                <option value="{{$status->id}}" {{$status->id == $feedback->status->id ? 'selected' : ''}}>{{$status->title}}</option>
                            @endforeach
                        </select>
                    @endrole
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>


@endsection
