@extends('layouts.app')

@section('content')
    @include('hills.article')

    


    <div class="mt-5">
        

        <a href="/trips/create" class="btn btn-info">
            create trip
        </a>
        <a href="/hills/{{ $hill->id }}/track" class="btn btn-danger">
            Start Trip
        </a>

        <form action="/userhillwishlist" method="POST">
            @csrf
            <input type="hidden" name="hill" value="{{ $hill->id }}">
            <input type="submit" class="btn btn-warning" value="add to wishlist">
        </form>
    </div>
    <div>
        @foreach ($hill->images as $img)
            <img src="{{ asset( $img->path ) }}" alt="">
        @endforeach
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