@extends('layouts.app')

@section('content')

<main class="homepage">

    <div class="container">

        <div>
            <h1 class="homepage-title">Ahoj {{ auth()->user()->name }}</h1>
            <p class="welcome-line">Kam sa dnes vydáš na dobrodružstvo?</p>
        </div>
        @include('partials.my-hills')
        <section>
            <div class="section-heading">

                <h2>Najnovšie dobrodružstvá</h2>
                <a href="/trips">Zobraziť všetky</a>
            </div>
            <div>
                @foreach ($trips as $trip)
                    @include('partials.trip-card')
                @endforeach
            </div>
        </section>
        <section class="users-ranklist">
            <div class="section-heading">

                <h2>Rebríček dobrodruhov</h2>
                <a href="/users">Zobraziť všetky</a>
            </div>
            <div class="users">

                <a href="/users/{{ $most_distance->id }}">

                    <article class="user">
                        <img src="{{ $most_distance->avatar_path }}" alt="">
                        <h4>
                            {{ $most_distance->name }}
                        </h4>
                        <p>Najviac nachodených kilometrov.</p>
                    </article>
                </a>

                <a href="/users/{{ $most_trips->id }}">

                    <article class="user">
                        <img src="{{ $most_trips->avatar_path }}" alt="">
                        <h4>
                            {{ $most_trips->name }}
                        </h4>
                        <p>Najviac absolvovaných dobrodružstiev.</p>
                    </article>
                </a>

                <a href="/users/{{ $most_time->id }}">

                    <article class="user">
                        <img src="{{ $most_time->avatar_path }}" alt="">
                        <h4>
                            {{ $most_time->name }}
                        </h4>
                        <p>Najviac času stráveného na horách.</p>
                    </article>
                </a>
            </div>
        </section>
    </div>
</main>

@endsection