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

    <main class="trip-edit">
        <div class="container">
            <header>
                <h1>Upraviť dobrodružstvo
                    <a href="/trips/{{ $trip->id }}" class="close-edit">
                        <i class="fas fa-times"></i>
                    </a>
                </h1>
            </header>
            <form action="/trips/{{ $trip->id }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
        
                <div class="form-group">
                    <label for="tripTitle">Názov:</label>
                    <input type="text" name="title" id="tripTitle" class="form-control" value="{{ $trip->title }}">
                </div>

                <div class="form-group">
                    <label for="tripDate">Dátum: </label>
                    <input type="date" class="form-control" name="date" id="tripDate" value="{{ Carbon\Carbon::parse($trip->date)->format('Y-m-d') }}">
                </div>
        
        
                {{-- TINY MCE EDITOR, may use in later versions --}}
                {{-- <textarea name="description" rows="5" cols="40" class="form-control tinymce-editor"></textarea> --}}
        
        
                
                <div class="form-group">
                    <label for="tripDesc">Popis: </label>
                    <textarea name="description" id="tripDesc" cols="30" rows="5" class="form-control">{{ $trip->description }}</textarea>
                </div>

                <div class="form-group trip-thumbnail">
                    <label for="thumbnail">Thumbnail:</label>
                    
                    <div class="thumbnail-wrapper">

                        @if ($trip->thumbnail_path != '/images/image-placeholder.png')
                            <img src="{{ asset($trip->thumbnail_path) }}" alt="" id="trip-thumbnail">
                            <input type="hidden" name="remove_thumbnail" value="false">
                            <input id="thumbnail" type="file" name="thumbnail" class="hide">

                            <a id="remove-thumbnail" class=""><i class="fas fa-times"></i></a>
                        @else
                            <input id="thumbnail" type="file" name="thumbnail" >
    
                        @endif
                    </div>

                    
                </div>

                <div class="form-group text-center">
                    <input type="submit" value="Upraviť" class="btn btn-primary">
                </div>
                
        
            </form>
        </div>
    </main>
    
@endsection