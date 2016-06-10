<div class="tags">
    Tags:
    @foreach ($image->tags as $tag)
        {{ $tag->tag }},
    @endforeach
</div>

