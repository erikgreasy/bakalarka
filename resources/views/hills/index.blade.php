@extends('layouts.app')

@section('content')
    @foreach ($hills as $hill)
        @include('hills.article')
        <a href="/hills/{{ $hill->id }}">Open</a>
    
    @endforeach
@endsection