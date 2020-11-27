@extends('layouts.app')


@section('content')

    <h3>

        {{ $user->name }} 
        @can('update', $user)
            /
            <small><a href="/users/{{ $user->id }}/edit">Edit</a></small>
        @endcan
    </h3>
    <p>

        {{ $user->email }}
    </p>
    <h3>Trips</h3>
    <ul>

        @forelse ($user->trips as $trip)
            <li>

                <a href="/trips/{{ $trip->id }}">
                    {{ $trip->title }}
                </a>
            </li>
        @empty
            No trips yet
        @endforelse
    </ul>
    
@endsection