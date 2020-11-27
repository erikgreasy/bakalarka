@extends( 'layouts.app' )


@section( 'content' )
    <h1>Are you ready?</h1>
    <a id="startTrip" href="#" class="btn btn-primary">

        Start my trip
    </a>

    <a href="#" id="stopTrip" class="btn btn-danger">
        Stop trip
    </a>

    <form action="/hills/1/track" method="POST">
        @csrf
        <input type="submit">
    </form>
@endsection