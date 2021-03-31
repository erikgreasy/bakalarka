@extends('layouts.app')

@section('content')
<div class="welcome">

    <div class="content container">
        <div class="text">
            <h1>Turista</h1>
            <p>Si pripravený odštartovať nové dobrodružstvo?</p>
        </div>
        <div class="buttons-wrapper">
            <p><small>Pre pokračovanie:</small></p>
            <div class="buttons">
                <a href="/login" class="btn btn-full">Prihlásiť sa</a>
                <a href="/register" class="btn btn-outline">Registrovať sa</a>
            </div>
    
        </div>
    </div>
</div>
@endsection
