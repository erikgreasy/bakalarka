@extends('layouts.app')

@section('content')

    <ul>

        @foreach ($mountains as $mountain)
            <li>
                <a href="/mountains/{{ $mountain->id }}">

                    {{ $mountain->name }}
                </a>
            </li>
        @endforeach

    </ul>

    
    
@endsection