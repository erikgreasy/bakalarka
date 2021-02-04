@extends('layouts.app')

@section('content')
    
    <div class="user-edit">
        <div class="container">
            <header>
                <h1>Nastavenia profilu
                    <a href="/users/{{ $user->id }}" class="close-edit">
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
            <form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                <div class="inputs">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Meno:</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                    </div>
           
                    <div class="form-group">
                        <label for="avatar">Profile pic:</label>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                </div>
        
                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
        
        
            </form>
        </div>
    </div>
    
@endsection