<div class="voting">
    <div>
        <span class="score">{{ $image->votes_up - $image->votes_down }}</span>
        points
    </div>
    <a href="/vote/{{ $image->filename }}/up">upvote</a>
    <a href="/vote/{{ $image->filename }}/down">downvote</a>
</div>

