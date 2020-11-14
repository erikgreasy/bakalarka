@extends('layouts.app')


@section('content')

    <p>

        {{ $user->name }}
    </p>
    <p>

        {{ $user->email }}
    </p>
    <h3>Trips</h3>
    @foreach ($user->trips as $trip)
        <p>
            <a href="/trips/{{ $trip->id }}">
                {{ $trip->title }}
            </a>
        </p>
    @endforeach
    
@endsection