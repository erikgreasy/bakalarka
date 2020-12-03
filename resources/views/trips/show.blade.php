@extends('layouts.app')

@section('content')
    <h2>{{ $trip->title }} / <small>{{ date( 'd.m.Y', strtotime( $trip->date ) ) }}</small></h2>
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

    @foreach ($trip->images as $img)
        <img src="{{ asset( $img->path ) }}" alt="">
    @endforeach

    @foreach ($trip->logs as $log)
        <p>
            {{ $log }}
        </p>
    @endforeach

    @can('update', $trip)
        <div>
            <a href="/trips/{{ $trip->id }}/edit" method="POST" class="btn btn-primary">
                Edit
            </a>
              
        </div>
        <div>
            <form action="/trips/{{ $trip->id }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('are you sure?')">Delete trip</button>
            </form>
        </div>
    @endcan

@endsection