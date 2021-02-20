@extends('layouts.app')

@section('content')
    <main class="trips-index">

        @include('partials/explore-links')
    
        <div class="container">
    
            <div class="explore-heading">
                <h3>Najnovšie dobrodružstvá</h3>
                <a href="/trips/filter"><i class="fas fa-filter fa-2x"></i></a>
            </div>
            @foreach ($trips as $trip)
                @include('partials.trip-card')
            
            @endforeach
        </div>
    </main>
@endsection