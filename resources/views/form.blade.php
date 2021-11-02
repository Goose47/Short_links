@extends('layouts.default')

@section('content')
    <h3>Short your link!</h3>

    @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="" method="post">
        @csrf
        <label for="originalUrl">Enter your url here:</label>
        <input name="originalUrl" type="text" value="{{ old('originalUrl') }}">
        <button class="btn btn-light" type="submit">Shorten!</button>
    </form>

    @isset($shortUrl)
        <div class="mt-5">
            <h4>Your shortened url:</h4>
            <a href="{{ $shortUrl }}">{{ $shortUrl }}</a>
        </div>
    @endisset
@endsection
