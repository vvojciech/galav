@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="page-header">{{ $title }}</h1>
        </div>
        <div class="row no-gutter images-container">
            @foreach ($images as $image)
                @include ('images._item')
            @endforeach
        </div>

    {!! $images->links() !!}
    </div>

@endsection


