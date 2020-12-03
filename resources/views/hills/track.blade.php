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

    

    
@endsection