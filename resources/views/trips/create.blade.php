@extends('layouts.app')

@section('content')



<main class="trip-create">
    <div class="container">
        <header>
            <h1>
                Nové dobrodružstvo
                <a href="javascript:window.history.back();" class="close-edit">
                    <i class="fas fa-times"></i>
                </a>
            </h1>
        </header>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/trips" method="POST" enctype="multipart/form-data">
        
                @csrf
        
                <div class="form-group">
                    <label for="tripTitle">Title:</label>
                    <input type="text" name="title" id="tripTitle" class="form-control" value="{{ old( 'title' ) }}">
                </div>

                <div class="form-group">
                    <label for="tripDate">Date of the trip: </label>
                    <input type="date" class="form-control" name="date" id="tripDate">
                </div>
                <div class="form-group">
        
                    @if ( $from_hill )
                        
                        <input type="number" value="{{ $from_hill }}"  name="hill" hidden>
                    @else 
                        <label for="hill">Hill: </label>
        
                        <select name="hill" id="hill" class="form-control">
        
                            @foreach ($hills as $hill)
                                <option value="{{ $hill->id }}">
                                    {{ $hill->name }}
                                </option>
                                
                            @endforeach
                        </select>
        
                    @endif
        
                    
                </div>
                
                <div class="form-group">
                    <label for="tripDesc">Text: </label>
                    <textarea name="description" id="tripDesc" cols="30" rows="5" class="form-control">{{ old( 'description' ) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail:</label>
                    <input id="thumbnail" type="file" name="thumbnail" class="">
                </div>

                <div class="form-group">
                    <label for="image">Fotky:</label>
                    <input id="image" type="file" name="image[]" class="" multiple>
                </div>
                <div class="form-group">
                    <input type="submit" value="Pridať" class="btn btn-primary">
                </div>
        
                
        
            </form>
        </div> <!-- END CONTAINER -->

    </main>
    
@endsection