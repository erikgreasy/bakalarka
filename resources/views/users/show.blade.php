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
        <div class="statistics-tabs">
            <div class="tab">
                <h5>1200</h5>
                <p>Sit amet</p>
            </div>
            <div class="tab">
                <h5>1200</h5>
                <p>Lorem sit</p>
            </div>
            <div class="tab">
                <h5>1200</h5>
                <p>sit ipsum</p>
            </div>
        </div>

        <div>
            <div class="container">
                <h3>Moje kopce</h3>
                <ul>
                    @foreach ($user->wishlists as $wish)
                        <li>
                            {{ $wish->hill->name }}
                            {{-- <form action="/userhillwishlist/{{ $wish->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="X">
                            </form> --}}
                        </li>
                        
                    @endforeach
                </ul>
            </div>
        </div>
        <div>
            <div class="container">
                <h3>Moje dobrodružstvá</h3>
                <ul>
    
                    @forelse ($user->trips as $trip)
                        <li>
            
                            <a href="/trips/{{ $trip->id }}">
                                {{ $trip->title }}
                            </a>
                        </li>
                    @empty
                        No trips yet
                    @endforelse
                </ul>
            </div>
        </div>
        
        <div class="floating-btn">
            
        </div>
        <ul class="floating-btn-options">
            @can('update', $user)
                <li>
                    <a href="/users/{{ $user->id }}/edit">Upraviť profil</a>
                </li>
            @endcan
            <li>
                <a href="javascript:void" onclick="$('#logout-form').submit();" class="logout-link">
                    Logout
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        

        
        
        
    </div>
    
@endsection