<div class="voting">
    <div class="btn btn-default">
        <span class="score">{{ $image->votes_up - $image->votes_down }}</span>
        points
    </div>
    <a class="btn btn-success fa fa-thumbs-up vote-action" data-vote="up" data-filename="{{ $image->filename }}"></a>
    <a class="btn btn-warning fa fa-thumbs-down vote-action" data-vote="down" data-filename="{{ $image->filename }}"></a>
</div>

