@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ $image->title }}</h1>
                Uploaded by <a href="{{ url('/u/' . $image->user->username) }}">{{ $image->user->username }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">

                <div class="row">
                    <img src="{{ url('/i/' . $image->filename . '.jpg') }}"/>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        @include ('images._favourite')
                    </div>
                    <div class="col-md-4">
                        @include ('images._votes')
                    </div>
                    <div class="col-md-4">
                        @include ('images._tags')
                    </div>
                    <div class="col-md-2">
                        @include ('images._report')
                    </div>

                </div>
                <div class="row">
                    <ul class="nav nav-tabs nav-justified">
                        <li role="presentation" class="active"><a data-toggle="tab" href="#comments">Comments</a></li>
                        <li role="presentation"><a data-toggle="tab" href="#related">Related</a></li>
                    </ul>


                    <div class="tab-content">
                        <div id="comments" class="tab-pane fade in active">
                            @include ('images._comments')
                        </div>
                        <div id="related" class="tab-pane fade in">
                            <p>@todo related</p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-sm-4">

                @include ('images._navigation')
                
            </div>
        </div>

    </div>


@endsection


