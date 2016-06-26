@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>{{ $image->title }}</h1>
                    Uploaded by <a href="{{ url('/u/' . $image->user->username) }}">{{ $image->user->username }}</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">

                <div class="image-container">
                    <img class="img-responsive" src="{{ url('/i/' . $image->filename . '.jpg') }}"/>
                </div>
                <div class="panel">
                    <div class="panel-body">

                        <div class="col-xs-10 col-sm-6">
                            @include ('images._favourite')
                            @include ('images._votes')
                        </div>
                        <div class="col-sm-4 hidden-xs">
                            @include ('images._tags')
                        </div>
                        <div class="col-xs-2">
                            @include ('images._report')
                        </div>

                    </div>
                </div>

                @include ('images._comments')

            </div>
            <div class="col-md-4 col-sm-4 hidden-xs">

                @include ('images._navigation')

            </div>
        </div>

    </div>


@endsection


