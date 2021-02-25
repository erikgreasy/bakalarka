@extends('layouts.app')

@section('content')

    <main class="users-index">
        <div class="container">
            <div class="users-page">
                <div class="explore-heading">
                    <h3>{{ $order_text }}</h3>
                    <a href="/users/filter"><i class="fas fa-filter fa-2x"></i></a>
                </div>
                <h3></h3>
            </div>
            <div class="users-ranklist">
                @foreach ($users as $index => $user)
                    @include( 'partials.user-card' )
                @endforeach
    
            </div>
            {{-- <ul>
                    <li>
                        
                    </li>
            </ul> --}}
        </div>
    </main>
    
@endsection