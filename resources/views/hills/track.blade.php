@extends( 'layouts.app' )


<script>
    
    var hill_id = {!! $hill_id !!}
</script>
@section( 'content' )

    <h1>Are you ready?</h1>
    <a id="startTrip" href="#" class="btn btn-primary">

        Start my trip
    </a>

    <a href="#" id="stopTrip" class="btn btn-danger">
        Stop trip
    </a>
    <input type="file" accept="image/*;capture=camera">
    <video id="webcam" autoplay playsinline width="640" height="480"></video>
    <canvas id="canvas" class="d-none"></canvas>
    <audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio>


    <button id="takePhoto">Click</button>
    <a href="#" id="download-photo">Download</a>

    
@endsection