@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload a file</div>
                    <div class="panel-body">

                        {!! Form::model(new App\Image, array('action' => 'ImagesController@store', 'files'=> true)) !!}

                        {!! BootForm::text('title') !!}

                        {!! BootForm::file('upload_file') !!}

                        {!! BootForm::text('tags', '', '') !!}

                        {!! BootForm::submit('Upload') !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
