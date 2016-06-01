{!! Form::model(new App\Report, array('action' => 'ReportsController@report')) !!}

{{ Form::hidden('filename', $image->filename) }}

<div class="form-group">
    {{ Form::label('report_reason_id', 'Reason:') }}
    {{ Form::select('report_reason_id', $report_reasons, null) }}
</div>

<div class="form-group">
    {{ Form::submit('Report') }}
</div>

{!! Form::close() !!}
