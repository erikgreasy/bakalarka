@extends('layouts.app')


@section('content')

    <img src="{{ asset( $user->avatar_path ) }}" alt="profile picture" class="user-avatar">
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
    <h3>Wishlist</h3>
    <ul>
        @foreach ($user->wishlists as $wish)
            <li>

                {{ $wish->hill->name }}
                <form action="/userhillwishlist/{{ $wish->id }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="X">
                </form>
            </li>
            
        @endforeach
    </ul>
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