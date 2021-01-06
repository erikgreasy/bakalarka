@extends('layouts.app')

@section('content')
    <div>
        <a href="/hills">Kopce</a>
        <a href="/trips">Dobrodružstvá</a>
    </div>
    <div>
        <h3>Najpopulárnejšie kopce</h3>
        <a href="#">Filter</a>
    </div>
    @foreach ($hills as $hill)
        {{-- @include('hills.article')
        <a href="/hills/{{ $hill->id }}">Open</a> --}}
        <article>
            <a href="/hills/{{ $hill->id }}">
                {{ $hill->name }}
            </a>

        </article>
    
    @endforeach
@endsection