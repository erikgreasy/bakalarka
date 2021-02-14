@extends( 'layouts.app' )


<script>
    
    var hill_id = {!! $hill_id !!}
</script>
@section( 'content' )
    <div class="track">
        <div class="container">
            <div class="destination">
                <p>Cieľ</p>
                <h1>{{ $hill->name }}</h1>
            </div>
            <div class="time">
                <p>Uplynutý čas</p>
                <h2 class="time-tracker">00:00:00</h2>
            </div>
            <div class="row">
                <div class="distance col-6">
                    <p>Prejdená vzdialenosť</p>
                    <h3>0.00<span>KM</span></h2>
                </div>

                <div class="speed col-6">
                    <p>Priemerná rýchlosť</p>
                    <h3>0.0<span>KM/H</span></h2>
                </div>
            </div>

            <input type="file" accept="image/*;capture=camera" id="takePhoto">
            <a id="startTrip" href="#" class="btn btn-light">
                Začať túru
            </a>
        
            <a href="#" id="stopTrip" class="btn btn-danger">
                Ukončiť túru
            </a>
        </div>
    </div>
    {{-- <video id="webcam" autoplay playsinline width="640" height="480"></video> --}}
    {{-- <canvas id="canvas" class="d-none"></canvas> --}}
    {{-- <audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio> --}}


    {{-- <button id="takePhoto">Click</button> --}}
    {{-- <a href="#" id="download-photo">Download</a> --}}

    
@endsection