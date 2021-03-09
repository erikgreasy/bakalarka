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
        @include( 'partials.user-statistics-tab' )

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
        <div class="floating-btn">
            <i class="fas fa-th"></i>
        </div>
        <ul class="floating-btn-options">
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
            </ul>
    @endcan
        

        
        
        
    </div>
    
@endsection