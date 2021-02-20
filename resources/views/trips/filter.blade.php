@extends('layouts.app')

@section('content')
    
    <main class="filter">
        <div class="container">

            <header>
                <h1>
                    {{-- <small class="reset">Reset</small> --}}
                    Filter
                    <a href="/trips" class="close-edit">
                        <i class="fas fa-times"></i>
                    </a>
                </h1>
            </header>

            <form action="/trips" method="GET">

                <div class="form-group">
                    <h2>Zoradiť od</h2>

                    <input type="radio" id="newest" name="order" value="newest" checked>
                    <label for="newest">Najnovšie</label>

                </div>

                <div class="form-group">
                    <h2>Pohoria</h2>

                    @foreach($mountains as $mountain)
                        <div>
                            <input type="checkbox" id="mountain_{{ $mountain->id }}" name="mountains[]" value="{{ $mountain->id }}">
                            <label for="mountain_{{ $mountain->id }}">{{ $mountain->name }}</label>
                        </div>
                    @endforeach

                </div>

                <div class="form-group">
                    <h2>Kopce</h2>

                    @foreach ($hills as $hill)
                        <div>
                            <input type="checkbox" id="hill_{{ $hill->id }}" name="hills[]" value="{{ $hill->id }}">
                            <label for="hill_{{ $hill->id }}">{{ $hill->name }}</label>
                        </div>

                    @endforeach

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary submit">Aplikovať</button>
                </div>
            </form>
        </div>
    </main>

@endsection