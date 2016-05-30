<a class="col-lg-3 col-md-3 col-xs-6 thumb gallery-item" href="{{ url('/i/' . $image->filename) }}">
    <img src="{{ url('/i/' . $image->filename . '.jpg') }}"/>
    <div class="gallery-item-title">{{ $image->title }}</div>
</a>