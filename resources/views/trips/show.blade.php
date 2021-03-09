@extends('layouts.app')

@section('content')
    <div class="trip-detail">

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
    </div>
    <div>
        @foreach( $trip->images as $image )
            <img src="{{ $image->path }}" alt="">
            
        @endforeach
    </div>

    <div class="floating-btn">
        <i class="fas fa-th"></i>
    </div>
    <ul class="floating-btn-options">
        <li>
            <a href="/trips/{{ $trip->id }}/edit">
                Upraviť trip
            </a>
        </li>
        
    </ul>
    

@endsection