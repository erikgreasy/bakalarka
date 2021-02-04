@extends('layouts.app')

@section('content')
    <div class="homepage">

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

                    @foreach ($users as $user)
                        <a href="">

                            <div class="user">
                                <img src="{{ $user->avatar_path }}" alt="">
                                <h4>
                                    {{ $user->name }}
                                </h4>
                                <p>Lorem ipsum dolor sit.</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        </div>
    </div>


@endsection