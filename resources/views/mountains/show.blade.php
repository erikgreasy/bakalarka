@extends('layouts.app')

@section('content')

    <h2>
        {{ $mountain->name }}
    </h2>

    <ul>
        @foreach ($mountain->hills as $hill)
            <li>
                <a href="/hills/{{ $hill->id }}">

                    {{ $hill->name }}
                </a>
            </li>
        @endforeach
    </ul>

    
    
@endsection