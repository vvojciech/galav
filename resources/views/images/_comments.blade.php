<div class="comment-add">
    {!! Form::model(new App\Comment, array('action' => 'CommentsController@store')) !!}

    {{ Form::hidden('filename', $image->filename) }}
    {{ Form::text('comment') }}

    <div class="form-group">
        {{ Form::submit('Comment') }}
    </div>

    {!! Form::close() !!}

</div>

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