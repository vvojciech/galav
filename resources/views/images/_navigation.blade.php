@if (isset($neighbours['next']))
    <a href="{{ url('/i/' . $neighbours['next']->filename) }}">
        <img style="width: 100px;" src="{{ url('/i/' . $neighbours['next']->filename . '-t.jpg') }}"/><br />
        next >>
    </a>
@endif
<br />
@if (isset($neighbours['prev']))
    <a href="{{ url('/i/' . $neighbours['prev']->filename) }}">
        <img style="width: 100px;" src="{{ url('/i/' . $neighbours['prev']->filename . '-t.jpg') }}"/><br />
        << prev
    </a>
@endif
