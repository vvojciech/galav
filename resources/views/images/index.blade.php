@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">{{ $title }}</h1>
            </div>

            @foreach ($images as $image)
                @include ('images._item')
            @endforeach

        </div>

    {{-- @todo pagination {!! $images->links() !!} --}}

@endsection


