@extends('layouts.app')

@section('content')


    
    <ul>

        @forelse ($trips as $trip)
            <li>
                <a href="/trips/{{ $trip->id }}">
                    {{ $trip->title }}
                </a>
            </li>
        @empty
            <p>No trips yet</p>
        @endforelse
    </ul>
    
@endsection