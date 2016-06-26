<a class="btn btn-default fa fa-flag report-action" data-toggle="modal" data-target="#report"></a>

<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="Report">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::model(new App\Report, array('action' => 'ReportsController@report')) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Report content</h4>
            </div>
            <div class="modal-body">


                {{ Form::hidden('filename', $image->filename) }}

                <div class="form-group">
                    {{ Form::label('report_reason_id', 'Reason:') }}
                    {{ Form::select('report_reason_id', $report_reasons, null, ['class' => 'form-control']) }}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {{ Form::submit('Report content', ['class' => 'btn btn-primary']) }}

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>