@extends('layouts.app')

@section('content')
    <main class="hills-index">
        @include('partials/explore-links')
        <div class="container">
            <div class="explore-heading">
                <h3>Najpopulárnejšie kopce</h3>
                <a href="/hills/filter"><i class="fas fa-filter fa-2x"></i></a>
            </div>
    
            @foreach ($hills as $hill)
                @include( 'partials/hill-card' )
            @endforeach
        </div>
    </main>
@endsection