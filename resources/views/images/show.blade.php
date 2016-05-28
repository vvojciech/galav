@extends('layouts.app')

@section('content')
    <div class="container single-gallery">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>{{ $image->title }}</h1></div>
                    <div class="panel-body">
                        <img src="{{ url('/images/' . $image->filename) }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
