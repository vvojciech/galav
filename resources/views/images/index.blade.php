@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <h1 class="page-header">{{ $title }}</h1>
        </div>
        <div class="row images-container">
            @foreach ($images as $image)
                @include ('images._item')
            @endforeach
        </div>

    {!! $images->links() !!}
    </div>

@endsection


