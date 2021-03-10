@extends('layouts.app')

@section('content')

<main class="trip-detail">

    <div class="trip-thumbnail">
        <img src="{{ asset($trip->thumbnail_path) }}" alt="">
        
    </div>
    <div>
        <div class="container">

            <h2>{{ $trip->title }}</h2>
            <p class="trip-user">{{ $trip->user->name }}</p>
            <div class="trip-stats">
                <div>
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $trip->hill->name }}
                </div>
                <div>
                    <i class="far fa-calendar"></i>
                    {{ date( 'd.m.Y', strtotime($trip->date) ) }}
                </div>
                @if($trip->distance)
                    <div>
                        <i class="fas fa-hiking"></i>
                        {{ $trip->distance }} km
                    </div>
                @endif
                @if($trip->duration)
                    <div>
                        <i class="far fa-clock"></i>
                        {{ $trip->duration }} s
                    </div>
                @endif
            </div>
            <p class="trip-desc">

                {!!  nl2br( $trip->description ) !!}
            </p>
        </div>
    </div>
    <div class="trip-images">
        @foreach( $trip->images as $image )
            <img src="{{ $image->path }}" alt="">
            
        @endforeach
    </div>
</main>

<x-floating_btn>

    <li>
        <a href="/trips/{{ $trip->id }}/edit">
            Upraviť trip
        </a>
    </li>
    <li>
        <a href="javascript:void" onclick="$('#delete-form').submit();" class="logout-link">
            Odstrániť trip
        </a>
        
        <form id="delete-form" action="/trips/{{ $trip->id }}" method="POST" style="display: none;">
            @method('DELETE')
            @csrf
        </form>
    </li>

</x-floating_btn>

    

@endsection