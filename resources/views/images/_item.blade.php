<div id="1" class="item col-md-3 col-sm-6 gallery-item">

    <h4><a href="{{ url('/i/' . $image->filename) }}">{{ $image->title }}</a></h4>
    <a href="{{ url('/i/' . $image->filename) }}">
        <img src="{{ url('/i/' . $image->filename . '-t.jpg') }}"/>
    </a>
    <div class="info">
        <span class="badge">tag1</span>
        <span class="badge">tag2</span>
    </div>

</div>

