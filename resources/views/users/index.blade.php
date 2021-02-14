@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="users-page">
            <div class="explore-heading">
                <h3>Najviac nachodených kilometrov</h3>
                <a href="/users/filter">Filter</a>
            </div>
            <h3></h3>
        </div>
        <div class="users-ranklist">
            @foreach ($users as $user)
                @include( 'partials.user-card' )
            @endforeach

        </div>
        {{-- <ul>
                <li>
                    
                </li>
        </ul> --}}
    </div>
    
@endsection