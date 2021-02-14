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
                    {{ $trip->hill->name }}
                    {{ $trip->date }}
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