
{!! Form::model(new App\Report, array('action' => 'FavouritesController@toggle')) !!}

{{ Form::hidden('filename', $image->filename) }}
{{ Form::hidden('action', ($favourite ? 'remove' : 'add') ) }}

<div class="form-group">
    {{ Form::submit(($favourite ? 'remove from Fav' : 'add to Fav')) }}
</div>

{!! Form::close() !!}

<div class="favourite">
    <a class="btn fa fa-heart{{ ($favourite ? '' : '-o')  }} favourite-action" data-filename="{{ $image->filename }}" data-action="{{ ($favourite ? 'remove' : 'add')  }}"></a>
</div>

