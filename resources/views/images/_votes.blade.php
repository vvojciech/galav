<div class="voting">
    <div class="btn btn-default">
        <span class="score">{{ $image->votes_up - $image->votes_down }}</span>
        points
    </div>
    <a class="btn btn-success fa fa-thumbs-up" href="/vote/{{ $image->filename }}/up"></a>
    <a class="btn btn-warning fa fa-thumbs-down" href="/vote/{{ $image->filename }}/down"></a>
</div>

