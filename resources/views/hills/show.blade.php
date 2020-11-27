@extends('layouts.app')

@section('content')
    @include('hills.article')

    <div>

        @foreach ($hill->images as $image)
            <img src="{{ URL('/uploads' . $image->path) }}" alt="">
        @endforeach
    </div>


    <div class="mt-5">
        <a href="/trips/create" class="btn btn-info">
            create trip
        </a>
        <a href="/hills/{{ $hill->id }}/track" class="btn btn-danger">
            Start Trip
        </a>
    </div>
    <h3>Trips</h3>
    <ul>

        @foreach ($hill->trips as $trip)
            <li>

                <a href="/trips/{{ $trip->id }}">
                    {{ $trip->title }}
                    
                </a>
            </li>
        @endforeach
    </ul>

    
@endsection