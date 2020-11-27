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

    <form action="/hills" method="POST">

        @csrf


        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="name">Description:</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="name">Height:</label>
            <input type="number" name="height" id="height" class="form-control"> m.n.m.
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
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>

        

    </form>
    
@endsection