@extends('layouts.app')


@section('content')
    <p>

        {{ $user->name }}
    </p>
    <p>

        {{ $user->email }}
    </p>
    <a href="/users/{{ $user->id }}/edit">Edit</a>
@endsection