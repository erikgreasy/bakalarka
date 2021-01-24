@extends('layouts.app')

@section('content')
    <div class="homepage">

        <div class="container">
    
            <div>
                <h1 class="homepage-title">Ahoj {{ auth()->user()->name }}</h1>
                <p class="welcome-line">Kam sa dnes vydáš na dobrodružstvo?</p>
            </div>
            <section>
                <div class="homepage-section-heading">
                    <h2>Moje kopce</h2>
                    <a href="#">Zobraziť všetky</a>

                </div>
                <div class="wishlist-cards">
                    @foreach ($hills as $hill)
                        @include('partials/wishlist-hill-card')
                    @endforeach
                </div>
            </section>
            <section>
                <div class="homepage-section-heading">

                    <h2>Najnovšie dobrodružstvá</h2>
                    <a href="#">Zobraziť všetky</a>
                </div>
                <div>
                    @foreach ($trips as $trip)
                        <a href="/trips/{{ $trip->id }}">
                            <article>
                                <h4>{{ $trip->title }}</h4>
                            </article>
                        </a>
                    @endforeach
                </div>
            </section>
            <section>
                <div class="homepage-section-heading">

                    <h2>Rebríček dobrodruhov</h2>
                    <a href="#">Zobraziť všetky</a>
                </div>
                @foreach ($users as $user)
                    <h4>
                        {{ $user->name }}
                    </h4>
                @endforeach
            </section>
        </div>
    </div>


@endsection