@extends('layouts.app')

@section('content')
    @include('partials/explore-links')

    <div class="container">

        <div class="explore-heading">
            <h3>Najnovšie dobrodružstvá</h3>
            <a href="#">Filter</a>
        </div>
        @foreach ($trips as $trip)
            @include('partials.trip-card')
        
        @endforeach
    </div>
@endsection