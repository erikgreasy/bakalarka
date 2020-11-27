@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="/trips/{{ $trip->id }}" method="POST">
        @method('PUT')
        @csrf

        <div class="form-group">
            <label for="tripDate">Date of the trip: </label>
            <input type="date" class="form-control" name="date" id="tripDate" value="{{ Carbon\Carbon::parse($trip->date)->format('Y-m-d') }}">
        </div>


        {{-- TINY MCE EDITOR, may use in later versions --}}
        {{-- <textarea name="description" rows="5" cols="40" class="form-control tinymce-editor"></textarea> --}}


        <div class="form-group">

            <label for="tripTitle">Title:</label>
            <input type="text" name="title" id="tripTitle" class="form-control" value="{{ $trip->title }}">
        </div>
        <div class="form-group">
            <label for="tripDesc">Text: </label>
            <textarea name="description" id="tripDesc" cols="30" rows="10" class="form-control">{{ $trip->description }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>
        

    </form>
    
@endsection