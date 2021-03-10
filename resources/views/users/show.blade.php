@extends('layouts.app')


@section('content')
    <div class="user-profile">
        <div class="top-section">
            <div class="user-details">
                <img src="{{ asset( $user->avatar_path ) }}" alt="profile picture" class="user-avatar">
                <h3 class="username">
                    {{ $user->name }} 
                </h3>
            </div>
        </div>


        <x-user_stats_tab :user="$user" />

        <div class="container mt-5">

        @can('update', $user)
            @include('partials.my-hills')
        @endcan

        <section>
            <div class="section-heading">
                <h2>Dobrodružstvá</h2>
                <a href="#">Zobraziť všetky</a>
        
            </div>
            @forelse ($user->trips as $trip)
                @include('partials.trip-card')
            @empty
                No trips yet
            @endforelse
        </section>
    </div>

        
        
    @can('update', $user)
        <x-floating_btn>

            <li>
                <a href="/users/{{ $user->id }}/edit">Upraviť profil</a>
            </li>
            <li>
                <a href="javascript:void" onclick="$('#logout-form').submit();" class="logout-link">
                    Logout
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </x-floating_btn>
    @endcan
        

        
        
        
    </div>
    
@endsection