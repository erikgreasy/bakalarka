const { data } = require('jquery');

require('./bootstrap');

let interval;
$('#startTrip').on( 'click', function() {
    getLocation()
    interval = setInterval(function() {
        getLocation()
    }, 4000);
} )

$('#stopTrip').on( 'click', function() {
    console.log( 'trip ended' )
    clearInterval( interval )
} )







function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
      
    } else {
        

      console.log( "Geolocation is not supported by this browser." );
    }
}


function showPosition(position) {

    console.log( `Lat: ${position.coords.latitude} Long:${ position.coords.longitude}` )
    console.log( { lat : position.coords.latitude } )
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'POST',
        data: { lat : position.coords.latitude, long : position.coords.longitude },
        // url:"{{ route('ajaxRequest.post') }}",
        url:"/hills/1/track",

        success:function(){
           console.log( 'success' );
        }
     });
}


// getLocation()


 
//  clearInterval(interval);
// navigator.geolocation.getCurrentPosition(showPosition) 