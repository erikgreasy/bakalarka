@extends('layouts.app')

@section('content')


    @foreach ($trips as $trip)
        {{ $trip->title }}
    @endforeach
    
@endsection