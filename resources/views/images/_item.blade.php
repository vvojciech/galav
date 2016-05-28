<a class="gallery-item" href="{{ url('/i/' . $image->filename) }}">
    <img src="{{ url('/images/' . $image->filename) }}" width="200"/>
    <div class="gallery-item-title">{{ $image->title }}</div>
</a>
