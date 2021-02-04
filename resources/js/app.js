const { data } = require('jquery');
import Webcam from 'webcam-easy';
var id, target, options;
import 'slick-carousel';

require('./bootstrap');
// require('./bootstrap');

var moment = require('moment');



/**
 * REGISTER SERVICE WORKER
 */
// if ('serviceWorker' in navigator) {
//     window.addEventListener('load', function() {
//         navigator.serviceWorker.register('/serviceWorker.js').then(function(registration) {
//             // Registration was successful
//             console.log('ServiceWorker registration successful with scope: ', registration.scope);
//         }, function(err) {
//             // registration failed :(
//             console.error('ServiceWorker registration failed: ', err);
//         });
//     });
// }


$( '.floating-btn' ).on( 'click', function() {
    console.log( 'hop' )
    console.log( $( '.floating-btn-option' ) )
    const optionsHeight = $( '.floating-btn-options' ).height() - 62
    console.log( optionsHeight + 'px' )
    $( 'body' ).toggleClass( 'floating-options-opened' )
    $( '.floating-btn-options' ).toggleClass( 'active' )
    
    if( $('body').hasClass('floating-options-opened') ) {
        $( this ).css({
            transform: `translateY(-${optionsHeight}px)`
        })
    } else {
        $( this ).css({
            transform: `translateY(0)`
        })
    }
} )

$('.wishlist-cards').slick({
    infinite: false,
    slidesToShow: 1.5,
    arrows: false,
})

$('#showInfo').click( function(e) {
    e.preventDefault()
    $('.content-sections section').hide()
    $('#info').show()
} )
$('#showTrips').click( function(e) {
    e.preventDefault()
    $('.content-sections section').hide()
    $('#trips').show()
} )
$('#showRanking').click( function(e) {
    e.preventDefault()
    $('.content-sections section').hide()
    $('#ranking').show()
} )

// $('.users').slick({
//     infinite: false,
//     slidesToShow: 3.5,
//     arrows: false,
// })

// const webcamElement = document.getElementById('webcam');
// const canvasElement = document.getElementById('canvas');
// const snapSoundElement = document.getElementById('snapSound');
// const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);


// webcam.start()
//   .then(result =>{
//     console.log("webcam started");
//   })
//   .catch(err => {
//     console.log(err);
// });

// $( '#takePhoto' ).click( function() {

//     let picture = webcam.snap();
//     console.log( picture )
//     document.querySelector('#download-photo').href = picture;
// } )










// document.querySelector('#get-access').addEventListener('click', async function init(e) {
//     try {
//       const stream = await navigator.mediaDevices.getUserMedia({
//         audio: false,
//         video: true
//       })
//       const videoTracks = stream.getVideoTracks()
//       const track = videoTracks[0]
//       alert(`Getting video from: ${track.label}`)
//       document.querySelector('video').srcObject = stream
//       document.querySelector('#get-access').setAttribute('hidden', true)
//   //The video stream is stopped by track.stop() after 3 second of playback.
//     //   setTimeout(() => { track.stop() }, 3 * 1000)
//     } catch (error) {
//       alert(`${error.name}`)
//       console.error(error)
//     }
//   })


//   var takePhotoButton = document.querySelector('button#takePhoto');
//   var canvas = document.querySelector('canvas');
  
//   takePhotoButton.onclick = takePhoto;
  
//   // Get a Blob from the currently selected camera source and
//   // display this with an img element.
//   function takePhoto() {
//     imageCapture.takePhoto().then(function(blob) {
//       console.log('Took photo:', blob);
//       img.classList.remove('hidden');
//       img.src = URL.createObjectURL(blob);
//     }).catch(function(error) {
//       console.log('takePhoto() error: ', error);
//     });
//   }



// // $( '#allowCamera' ).click( function() {

// //     navigator.mediaDevices.getUserMedia({
// //         video: true,
// //         facingMode: {
// //             //Use the back camera
// //             exact: 'environment'
// //         }
// //     })
// //     // console.log( navigator.mediaDevices.getSupportedConstraints() )
// // } )

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
            title: 'New trip ' + moment().format( 'Y-M-D HH:mm:ss' ),
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




