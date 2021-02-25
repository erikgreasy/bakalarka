@extends('layouts.app')

@section('content')
    <main>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="container">
                <h2>Nový kopec</h2>
                <form action="/hills" method="POST" enctype="multipart/form-data">
            
                    @csrf
            
            
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    </div>
            
                    <div class="form-group">
                        <label for="name">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('decscription') }}</textarea>
                    </div>
            
                    <div class="form-group">
                        <label for="name">Height:</label>
                        <input type="number" name="height" id="height" class="form-control" value="{{ old('height') }}"> m.n.m.
                    </div>
            
                    <div class="form-group">
                        <label for="name">Mountain:</label>
                        <select name="mountain" id="mountain" class="form-control">
                            @foreach ($mountains as $mountain)
                                <option value="{{ $mountain->id }}">{{ $mountain->name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="name">Lat:</label>
                        <input type="text" name="lat" id="lat" class="form-control">
                    </div>
            
                    <div class="form-group">
                        <label for="name">Long:</label>
                        <input type="text" name="long" id="long" class="form-control">
                    </div>
            
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail:</label>
                        <input id="thumbnail" type="file" name="thumbnail">
                    </div>

                    <div class="form-group">
                        <label for="images"></label>
                        <input id="images" type="file" name="images[]" class="" multiple>
                    </div>

            
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
            
                    
            
                </form>
            </div> <!-- END CONTAINER -->
    </main>

    
@endsection