@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ $title }}</h1>
                </div>
            </div>
        </div>
        <div class="row no-gutter images-container">
            @foreach ($images as $image)
                @include ('images._item')
            @endforeach
        </div>

    {!! $images->links() !!}
    </div>

@endsection


