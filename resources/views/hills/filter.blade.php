@extends('layouts.app')

@section('content')
    
    <main class="filter">
        <div class="container">

            <header>
                <h1>
                    {{-- <small class="reset">Reset</small> --}}
                    Filter
                    <a href="/hills" class="close-edit">
                        <i class="fas fa-times"></i>
                    </a>
                </h1>
            </header>

            <form action="/hills" method="GET">

                <div class="form-group">
                    <h2>Zoradiť od</h2>

                    <input type="radio" id="male" name="order" value="newest" checked>
                    <label for="male">Najnovšie</label>

                    <input type="radio" id="female" name="order" value="highest">
                    <label for="female">Najvyššie</label>

                    <input type="radio" id="other" name="order" value="other">
                    <label for="other">Najobľúbenejšie</label>
                </div>

                <div class="form-group">
                    <h2>Pohoria</h2>

                    @foreach( $mountains as $mountain )

                        <div>
                            <input type="checkbox" id="moutain_{{ $mountain->id }}" name="mountains[]" value="{{ $mountain->id }}">
                            <label for="moutain_{{ $mountain->id }}">{{ $mountain->name }}</label>
                        </div>
                    @endforeach

                    {{-- <div>
                        <input type="checkbox" id="mala_fatra" name="hill[]" value="mala_fatra">
                        <label for="mala_fatra">Malá Fatra</label>
                    </div>

                    <div>
                        <input type="checkbox" id="velka_fatra" name="hill[]" value="velka_fatra">
                        <label for="velka_fatra">Veľká Fatra</label>
                    </div>

                    <div>
                        <input type="checkbox" id="vysoke_tatry" name="hill[]" value="vysoke_tatry">
                        <label for="vysoke_tatry">Vysoké Tatry</label>
                    </div>

                    <div>
                        <input type="checkbox" id="nizke_tatry" name="hill" value="nizke_tatry">
                        <label for="nizke_tatry">Nízke Tatry</label>
                    </div> --}}
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary submit">Aplikovať</button>
                </div>
            </form>
        </div>
    </main>

@endsection