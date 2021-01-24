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
            <a href="/hills/{{ $hill->id }}">
                <article class="hill">
                    <div class="image"></div>
                    <div>

                        <h4>
    
                            {{ $hill->name }}
                        </h4>
                        <p>
                            {{ $hill->height }} m.n.m.
                        </p>
                        <p class="description">
                            {{ $hill->description }}
                        </p>
                    </div>
                    
                </article>
            </a>
        
        @endforeach
    </div>
@endsection