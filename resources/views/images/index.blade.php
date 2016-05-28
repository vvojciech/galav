@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>{{ $title }}</h1></div>
                    <div class="panel-body">
                        @foreach ($images as $image)
                            @include ('images._item')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
