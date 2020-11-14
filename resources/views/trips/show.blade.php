@extends('layouts.app')

@section('content')
    <h2>{{ $trip->title }}</h2>
        <a href="/hills/{{ $trip->hill->id }}">
            {{ $trip->hill->name }}
        </a>
        /
        <a href="/users/{{ $trip->user->id }}">
            {{ $trip->user->name }}
        </a>
    <p>
        {!! nl2br( $trip->description ) !!}

    </p>
@endsection