@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('feedback.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name: </strong>
                {{ $feedback->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Message: </strong>
                {{ $feedback->message }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                @if($feedback->status->id == 3)
                <strong>Status: </strong>
                <span style="color:green;font-size: 14px"><b>{{ $feedback->status->title }}</b></span>
                @elseif($feedback->status->id == 4)
                    <strong>Status: </strong>
                    <span style="color:red;font-size: 14px"><b>{{ $feedback->status->title }}</b></span>
                @else
                    <strong>Status: </strong>
                    <span style="color:royalblue;font-size: 14px"><b>{{ $feedback->status->title }}</b></span>
                @endif
            </div>
        </div>
        @if($feedback->file)
            <img  src="{{ asset($feedback->file) }}" alt="user-img" width="400">
        @endif
    </div>
@endsection
