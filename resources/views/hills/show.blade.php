@extends('layouts.app')

@section('content')
    @include('hills.article')

    <div>

        @foreach ($hill->images as $image)
            <img src="{{ URL('/uploads' . $image->path) }}" alt="">
        @endforeach
    </div>

    <h3>Trips</h3>
    @foreach ($hill->trips as $trip)
        <a href="/trips/{{ $trip->id }}">
            {{ $trip->title }}
            
        </a>
    @endforeach
@endsection