@extends('layouts.app')

@section('content')
    @include('partials/explore-links')

    <div class="container">

        <div class="explore-heading">
            <h3>Najnovšie dobrodružstvá</h3>
            <a href="#">Filter</a>
        </div>
        @foreach ($trips as $trip)
            {{-- @include('hills.article')
            <a href="/hills/{{ $hill->id }}">Open</a> --}}
            <article>
                <a href="/trips/{{ $trip->id }}">
                    {{ $trip->title }}
                </a>
    
            </article>
        
        @endforeach
    </div>
@endsection