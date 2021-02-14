@extends('layouts.app')

@section('content')
    
    <main class="filter">
        <div class="container">

            <header>
                <h1>
                    <small class="reset">Reset</small>
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

                    <input type="radio" id="longest" name="order" value="longest">
                    <label for="longest">Najdlhšie</label>

                    <input type="radio" id="other" name="order" value="other">
                    <label for="other">Najobľúbenejšie</label>
                </div>

                <div class="form-group">
                    <h2>Pohoria</h2>

                    <div>
                        <input type="checkbox" id="mala_fatra" name="mountain" vlaue="mala_fatra">
                        <label for="mala_fatra">Malá Fatra</label>
                    </div>

                    <div>
                        <input type="checkbox" id="velka_fatra" name="mountain" value="velka_fatra">
                        <label for="velka_fatra">Veľká Fatra</label>
                    </div>

                    <div>
                        <input type="checkbox" id="vysoke_tatry" name="mountain" value="vysoke_tatry">
                        <label for="vysoke_tatry">Vysoké Tatry</label>
                    </div>

                    <div>
                        <input type="checkbox" id="nizke_tatry" name="mountain" value="nizke_tatry">
                        <label for="nizke_tatry">Nízke Tatry</label>
                    </div>
                </div>

                <div class="form-group">
                    <h2>Kopce</h2>

                    @foreach ($hills as $hill)
                        <div>
                            <input type="checkbox" id="hill_{{ $hill->id }}" name="hill[]" value="{{ $hill->id }}">
                            <label for="hill_{{ $hill->id }}">{{ $hill->name }}</label>
                        </div>

                    @endforeach
                    {{-- <div>
                        <input type="checkbox" id="mala_fatra" name="hill" vlaue="mala_fatra">
                        <label for="mala_fatra"></label>
                    </div>

                    <div>
                        <input type="checkbox" id="velka_fatra" name="hill" value="velka_fatra">
                        <label for="velka_fatra">Veľká Fatra</label>
                    </div>

                    <div>
                        <input type="checkbox" id="vysoke_tatry" name="hill" value="vysoke_tatry">
                        <label for="vysoke_tatry">Vysoké Tatry</label>
                    </div>

                    <div>
                        <input type="checkbox" id="nizke_tatry" name="hill" value="nizke_tatry">
                        <label for="nizke_tatry">Nízke Tatry</label>
                    </div>
                </div> --}}

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Aplikovať</button>
                </div>
            </form>
        </div>
    </main>

@endsection