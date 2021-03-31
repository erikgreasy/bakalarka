@extends('layouts.app')

@section('content')

<main id="offline" class="pt-5">


    <div class="container">
        <div class="content-wrapper">
            <img src="{{ asset('images/offline.png') }}" alt="no connection icon">
            <div class="message">
                Táto stránka vyžaduje dátové pripojenie
            </div>
        </div>
    </div>

</main>

@endsection