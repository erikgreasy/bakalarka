@extends('layouts.app')

@section('content')
    @include('partials/explore-links')
    <div class="container">
        <div class="explore-heading">
            <h3>Najpopulárnejšie kopce</h3>
            <a href="#" class="filter"><i class="fas fa-filter fa-2x"></i></a>
        </div>

        @foreach ($hills as $hill)
            {{-- @include('hills.article')
            <a href="/hills/{{ $hill->id }}">Open</a> --}}
            @include( 'partials/hill-card' )
        
        @endforeach
    </div>
@endsection