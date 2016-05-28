@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
@if ($errors->any())
    <div class='flash alert-danger'>
        @foreach ( $errors->all() as $error )
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif