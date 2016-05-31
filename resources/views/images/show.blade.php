@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">{{ $image->title }}</h1>
                Uploaded by <a href="{{ url('/u/' . $image->user->username) }}">{{ $image->user->username }}</a>
            </div>

            <img src="{{ url('/images/' . $image->filename) }}"/>

            @include ('images._votes')

            @include ('images._tags')
            @include ('images._report')

        </div>

        <div class="row">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="active"><a data-toggle="tab" href="#comments">Comments</a></li>
                <li role="presentation"><a data-toggle="tab" href="#related">Related</a></li>
            </ul>


            <div class="tab-content">
                <div id="comments" class="tab-pane fade in active">
                    <p>@todo comments</p>
                </div>
                <div id="related" class="tab-pane fade in">
                    <p>@todo related</p>
                </div>
            </div>

        </div>
    </div>


@endsection


