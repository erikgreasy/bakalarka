const { data } = require('jquery');
var id, target, options;

require('./bootstrap');
var moment = require('moment');


function startTrip() {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    return $.ajax({
        type:'POST',
        data: { 
            date: moment().format( 'Y-M-D HH:mm:ss' ),
            title: 'New title',
            description: 'Add description',
            hill: hill_id

        },
        url:"/trips",

        success:function( response ){
            trip_id = response.trip_id 
        },
        error: function( xhr, status, error ) {
            let err = JSON.parse(xhr.responseText)
            console.log( err )
        }
    });
}

let interval;
$('#startTrip').on( 'click', function() {
    $(this).hide()
    $('#stopTrip').show()
    startTrip()
        .then( response => {
        console.log( response )
        // id = navigator.geolocation.watchPosition(success, error, options);
        
    } )
        .catch( error => {
            $('#stopTrip').hide()

            alert( 'error occured' )

        } )
} )

// $('#startTrip').on( 'click', function() {
//     console.log( 'trip started' )
    
//     // load headers with CSRF token for laravel to be happy
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     // make POST request with data to create a new trip
//     $.ajax({
//         type:'POST',
//         data: { 
//             date: moment().format( 'Y-M-D' ),
//             title: 'New title',
//             description: 'Add description',
//             hill: hill_id

//         },
//         url:"/trips",

//         success:function( response ){
//             trip_id = response.trip_id 
//         },
//         error: function( xhr, status, error ) {
//             let err = JSON.parse(xhr.responseText)
//             console.log( err )
//         }
//     });
//     id = navigator.geolocation.watchPosition(success, error, options);
//     $(this).hide()
//     $('#stopTrip').show()
//     // getLocation()
//     // interval = setInterval(function() {
//     //     getLocation()
//     // }, 4000);
// } )

$('#stopTrip').on( 'click', function() {
    console.log( 'trip ended' )
    $(this).hide()
    
    // clearInterval( interval )
    navigator.geolocation.clearWatch( id )

    window.location.replace("/trips/" + trip_id);
} )



function success(pos) {
  var crd = pos.coords;

  console.log( crd )
  console.log( trip_id )
  return
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'POST',
        data: { trip_id: trip_id, lat : crd.latitude, long : crd.longitude },
        // url:"{{ route('ajaxRequest.post') }}",
        url:"/hills/1/track",

        success:function(){
            console.log( { trip_id: trip_id, lat : crd.latitude, long : crd.longitude } );
        },
        error: function( xhr, status, error ) {
            let err = JSON.parse(xhr.responseText)
            console.log( err )
        }
    });
//   if (target.latitude === crd.latitude && target.longitude === crd.longitude) {
//     console.log('Congratulations, you reached the target');
//     navigator.geolocation.clearWatch(id);
//   }
}

function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
}

target = {
  latitude : 0,
  longitude: 0
};

options = {
  enableHighAccuracy: false,
  timeout: 5000,
  maximumAge: 0
};


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

