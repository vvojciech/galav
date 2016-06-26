<div class="row navigation">
    @if (isset($neighbours['prev']))
        <a class="prev" href="{{ url('/i/' . $neighbours['prev']->filename) }}">
            <img src="{{ url('/i/' . $neighbours['prev']->filename . '-t.jpg') }}"/>
        </a>
    @endif
    @if (isset($neighbours['next']))
        <a class="next" href="{{ url('/i/' . $neighbours['next']->filename) }}">
            <img src="{{ url('/i/' . $neighbours['next']->filename . '-t.jpg') }}"/>
        </a>
    @endif

</div>