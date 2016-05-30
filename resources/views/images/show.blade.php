@extends('layouts.app')

@section('content')
    <div class="container single-gallery">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>{{ $image->title }}</h1>
                        Uploaded by <a href="{{ url('/u/' . $image->user->username) }}">{{ $image->user->username }}</a>
                    </div>
                    <div class="panel-body">
                        <img src="{{ url('/images/' . $image->filename) }}"/>

                        @include ('images._votes')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
