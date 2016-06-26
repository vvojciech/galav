<div class="panel comments">
    <div class="panel-heading">
        Latest comments
        <button class="btn btn-info comment-adder-show-action" data-adder=".comment-adder">Add Comment</button>
    </div>
    <div class="panel-body comment-adder">

        {!! Form::model(new App\Comment, array('action' => 'CommentsController@store')) !!}

        {{ Form::hidden('filename', $image->filename) }}
        {!! BootForm::text('comment', 'Comment (todo explain rules)') !!}

        {!! BootForm::submit('Comment') !!}

        {!! Form::close() !!}

    </div>
    <div class="panel-body">
        <div>
            @foreach ($comments as $comment)
                <div class="comment">
                    {{ $comment->user->username }} said on {{ $comment->created_at }}:
                    <blockquote>
                        {{ $comment->comment }}
                    </blockquote>
                </div>
            @endforeach
        </div>
    </div>
</div>

