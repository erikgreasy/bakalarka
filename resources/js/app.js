const { data } = require('jquery');
// import Webcam from 'webcam-easy';
var id, target, options;
import 'slick-carousel';

require('./bootstrap');
// require('./bootstrap');

var moment = require('moment');

var distance = 0;
var lastCoords = null;

$('#remove-thumbnail').click(function(e) {
    if(confirm('Naozaj chcete odstrániť náhľadový obrázok?')) {
        $('input[name=remove_thumbnail]').val('true')
        $('input#thumbnail').show()
        $('img#trip-thumbnail').hide()
        $(this).hide()
    }
})

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

// SLICK
$('.wishlist-cards').slick({
    infinite: false,
    slidesToShow: 1.5,
    arrows: false,
})

$('.trip-detail .trip-images').slick({
    infinite: false,
    slidesToShow: 1.5,
    arrows: false,
})
$('.users').slick({
    infinite: false,
    slidesToShow: 2.5
})

// $( '#info .gallery' ).slick({
//     slidesToShow: 2
// })



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

    // POST request to /trips -> store method in Trip Controller gets called
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

var trip_id;
let interval;
var startTime;
$('#startTrip').on( 'click', function() {
    $(this).hide()
    $('#stopTrip').show()
    startTrip()
        .then( response => {
            console.log( response )
            trip_id = response.trip_id;
            startTime = new Date();

            var intervalID = window.setInterval(myCallback, 1000);
            id = navigator.geolocation.watchPosition(success, error, options);
        
    } )
        .catch( error => {
            $('#stopTrip').hide()

            alert( 'error occured' )

        } )
} )



function myCallback() {
    var timeNow = new Date();

    var secondsPassed = parseInt( (timeNow - startTime) / 1000 );
    var hours = parseInt( secondsPassed / 3600 ).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
    secondsPassed -= parseInt( hours * 3600 );
    var minutes = parseInt( secondsPassed / 60 ).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
    secondsPassed -= parseInt( minutes * 60 )
    var seconds = secondsPassed.toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
    $( '.time .time-tracker' ).html(`${hours}:${minutes}:${seconds}`)
}

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
    $.ajax({
        type: 'POST',
        data: {
            trip_id: trip_id, 
            duration: parseInt(new Date() - startTime) / 1000,
            distance: distance
        },

        url: "/trips/" + trip_id + "/end-trip",
        success: function() {
            alert('success')
        },
        error: function() {
            alert('error')
        }

    })
    // alert(parseInt(new Date() - startTime) / 1000 + 'sekund' )

    window.location.replace("/trips/" + trip_id);
} )


function degreesToRadians(degrees) {
    return degrees * Math.PI / 180;
}

function countDistance(lat1, lon1, lat2, lon2) {
    var earthRadiusKm = 6371;
    var dLat = degreesToRadians(lat2-lat1);
    var dLon = degreesToRadians(lon2-lon1);

    lat1 = degreesToRadians(lat1);
    lat2 = degreesToRadians(lat2);

    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
    return earthRadiusKm * c;
}

function success(pos) {
    var crd = pos.coords;
    var speed = crd.speed;
    var speedHTML = $('.speed h3');
    var distanceHTML = $('.distance h3');
    // distance += 10;
    if(lastCoords) {
        distance += countDistance( lastCoords.latitude, lastCoords.longitude, crd.latitude, crd.longitude )
        // distance += 5;
    }
    lastCoords = crd;
    console.log( `last coords: ${lastCoords}` )


    if( !speed ) {
        speed = 0;
    } else {
        // get speed in KM/H
        speed = speed * (8/15);
    }
    
    speedHTML.text(parseFloat(speed).toFixed(1))
    distanceHTML.text( parseFloat(distance).toFixed(2) );

    console.log( trip_id )
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'POST',
        data: { 
            trip_id: trip_id, 
            lat : crd.latitude, 
            long : crd.longitude,
            speed : speed
        },
        // url:"{{ route('ajaxRequest.post') }}",
        url:"/hills/"+ hill_id +"/track",

        success:function(){
            console.log( { trip_id: trip_id, lat : crd.latitude, long : crd.longitude } );
        },
        error: function( xhr, status, error ) {
            let err = JSON.parse(xhr.responseText)
            console.log( err )
        }
    });
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


// function showPosition(position) {

//     console.log( `Lat: ${position.coords.latitude} Long:${ position.coords.longitude}` )
//     console.log( { lat : position.coords.latitude } )
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         type:'POST',
//         data: { lat : position.coords.latitude, long : position.coords.longitude },
//         // url:"{{ route('ajaxRequest.post') }}",
//         url:"/hills/" + hill_id +  "/track",

//         success:function(){
//            console.log( 'success' );
//         },
//         error:function() {
//             alert('error on log')
//         }
//      });
// }




