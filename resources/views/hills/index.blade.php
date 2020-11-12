@extends('layouts.app')

@section('content')
    @foreach ($hills as $hill)
        @include('hills.show')
    @endforeach
@endsection