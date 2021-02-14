@extends('layouts.app')

@section('content')
    
    <main class="filter">
        <div class="container">

            <header>
                <h1>
                    <small class="reset">Reset</small>
                    Filter
                    <a href="/users" class="close-edit">
                        <i class="fas fa-times"></i>
                    </a>
                </h1>
            </header>

            <form action="/users" method="GET">

                <div class="form-group">
                    <h2>Zoradiť od najviac</h2>

                    <input type="radio" id="newest" name="order" value="newest" checked>
                    <label for="newest">Dobrodružstiev</label>

                    <input type="radio" id="longest" name="order" value="longest">
                    <label for="longest">Kilometrov</label>

                    <input type="radio" id="time" name="order" value="time">
                    <label for="time">Času stráveného na horách</label>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Aplikovať</button>
                </div>
            </form>
        </div>
    </main>

@endsection