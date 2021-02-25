@extends('layouts.app')

@section('content')
    <main class="hill-show">

        <div class="top-section" style="background-image: url({{ asset( $hill->thumbnail_path ) }})">
            <div class="content">

                <div>
                    <h1>
                        {{ $hill->name }}
                    </h1>
                    <p>
                        {{ $hill->mountain->name }}
                    </p>
                </div>

                @if( $userhillwishlist )
                    <div class="add-to-wishlist">
                        <form action="/userhillwishlist/{{ $userhillwishlist->id }}" method="POST">
                            @csrf
                            @method( 'DELETE' )
                            <input type="hidden" name="hill" value="{{ $hill->id }}">
                            <button type="submit">
                                <i class="fas fa-star"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="add-to-wishlist">
                        <form action="/userhillwishlist" method="POST">
                            @csrf
                            <input type="hidden" name="hill" value="{{ $hill->id }}">
                            <button type="submit">
                                <i class="far fa-star"></i>
                            </button>
                        </form>
                    </div>
                @endif

               
            </div>
        </div>
        
        @include( 'partials.statistics-tab' )

        <div class="container">

            <div class="hill-tabs">
                <a href="#" id="showTrips">Návštevy</a>
                <a href="#info" id="showInfo">Info</a>
                <a href="#ranking" id="showRanking">Rebríček</a>
            </div>
        
            <div class="content-sections">

                <section id="trips">
                    @foreach( $hill->trips as $trip )
                        @include('partials.trip-card')
                    @endforeach
                    {{-- <a href="/trips/create" class="btn btn-info">
                        create trip
                    </a> --}}
                    {{-- <a href="/hills/{{ $hill->id }}/track" class="btn btn-danger">
                        Start Trip
                    </a> --}}
            
                    
                </section>
                <section id="info">
                    {{ $hill->description }}
                    <div class="gallery">

                        @foreach ($hill->images as $img)
                            <div class="gallery-item">
                                <img src="{{ asset($img->path) }}" alt="">
                            </div>
                            
                        @endforeach
                    </div>
                </section>
                <section id="ranking">
                    toto je ranking
                </section>
            </div>


            
        
            
        </div>
    </main>
    <div class="floating-btn">
        <i class="fas fa-th"></i>
    </div>
    <ul class="floating-btn-options">
        <li>
            <a href="/hills/{{$hill->id}}/track">
                Vyštartovať teraz
            </a>
        </li>
        <li>
            <a href="/trips/create">
                Pridať záznam túry
            </a>
        </li>
    </ul>
    
@endsection