<a class="col-lg-2 col-md-2 col-xs-6 thumb gallery-item" href="{{ url('/i/' . $image->filename) }}">
    <img src="{{ url('/images/' . $image->filename) }}"/>
    <div class="gallery-item-title">{{ $image->title }}</div>
</a>