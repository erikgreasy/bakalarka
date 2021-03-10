<div class="statistics-tabs">
    <div class="tab">
        <h5>{{ $user->timeOnHills() }}</h5>
        <p>Čas na horách</p>
    </div>
    <div class="tab">
        <h5>{{ $user->walkedDistance() }}</h5>
        <p>Prejdných kilometrov</p>
    </div>
    <div class="tab">
        <h5>{{ count($user->trips) }}</h5>
        <p>Túr na horách</p>
    </div>
</div>