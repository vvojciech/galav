@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload a file</div>
                    <div class="panel-body">

                        {!! Form::model(new App\Image, array('action' => 'ImagesController@store', 'files'=> true)) !!}

                        <div class="form-group">
                            {{ Form::label('title', 'Title') }}
                            {{ Form::text('title') }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('upload_file', 'File') }}
                            {{ Form::file('upload_file') }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('tags', 'Tags:') }}
                            {{ Form::text('tags', '') }}
                        </div>

                        <div class="form-group">
                            {{ Form::submit('Upload') }}
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
