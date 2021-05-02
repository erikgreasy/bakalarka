<template>
    <div class="track">
        <div class="container">
            <div class="destination">
                <p>Cieľ</p>
                <h1>{{ hill.name }}</h1>
            </div>
            <div class="time">
                <p>Uplynutý čas</p>
                <h2 class="time-tracker">00:00:00</h2>
            </div>
            <div class="row">
                <div class="distance col-6">
                    <p>Prejdená vzdialenosť</p>
                    <h3>{{ parseFloat(distance).toFixed(2) }}</h3>
                    <span>KM</span>
                </div>

                <div class="speed col-6">
                    <p>Rýchlosť</p>
                    <h3>{{ parseFloat(speed).toFixed(2) }}</h3>
                    <span>KM/H</span>
                </div>
            </div>

            <input type="file" accept="image/*;capture=camera" id="takePhoto">
            <a @click.prevent="startTrip" id="startTrip" href="#" class="btn btn-light">
                Začať túru
            </a>
        
            <a @click.prevent="stopTrip" href="#" id="stopTrip" class="btn btn-danger">
                Ukončiť túru
            </a>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    // props: ['hill'],

    data() {
        return {
            speed: 0,
            distance: 0,
            trip_id: null,
            geoId: null,
            lastCoords: null,
            hill: {
                id: 2,
                name: 'asdasd'
            },
            geoOptions: {
                enableHighAccuracy: false,
                timeout: 5000,
                maximumAge: 0
            }
        }
    },

    methods: {
        startTrip() {
            document.getElementById('stopTrip').style.display = 'block';
            document.getElementById('startTrip').style.display = 'none';


            axios.post('/api/trips', {
                title: 'New trip ',
                description: 'Add description',
                hill_id: this.hill.id,
                date: moment().format( 'Y-MM-DD HH:mm:ss' )
            })
                .then(res => {
                    console.log(res)
                    this.geoId = navigator.geolocation.watchPosition(this.success, this.error, this.geoOptions);

                })
                .catch(err => {
                    if( err.response.status == 422 ) {
                        console.log('Chyba pri validacii udajov, pri vytvarani tripu');
                        console.log(err.response.data.errors)
                    }

                })

        },

        stopTrip() {
            
            // clearInterval( interval )
            navigator.geolocation.clearWatch( this.geoIdid )
            // $.ajax({
            //     type: 'POST',
            //     data: {
            //         trip_id: trip_id, 
            //         duration: parseInt(new Date() - startTime) / 1000,
            //         distance: distance
            //     },

            //     url: "/trips/" + trip_id + "/end-trip",
            //     success: function() {
            //         alert('success')
            //     },
            //     error: function() {
            //         alert('error')
            //     }

            // })
            // alert(parseInt(new Date() - startTime) / 1000 + 'sekund' )

            // window.location.replace("/trips/" + trip_id);
            this.$router.push('/trips/' + this.trip_id);
        },

        
        success(pos) {
            console.log('success')

            var crd = pos.coords;
            this.speed = crd.speed * (8/15);

            if(this.lastCoords) {
                this.distance += this.countDistance( this.lastCoords.latitude, this.lastCoords.longitude, crd.latitude, crd.longitude )
            }
            this.lastCoords = crd;

            // console.log( trip_id )
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            // $.ajax({
            //     type:'POST',
            //     data: { 
            //         trip_id: trip_id, 
            //         lat : crd.latitude, 
            //         long : crd.longitude,
            //         speed : speed
            //     },
            //     // url:"{{ route('ajaxRequest.post') }}",
            //     url:"/hills/"+ hill_id +"/track",

            //     success:function(){
            //         console.log( { trip_id: trip_id, lat : crd.latitude, long : crd.longitude } );
            //     },
            //     error: function( xhr, status, error ) {
            //         let err = JSON.parse(xhr.responseText)
            //         console.log( err )
            //     }
            // });
        },

        error(err) {
            console.log('error')
        },

        
        degreesToRadians(degrees) {
            return degrees * Math.PI / 180;
        },

        countDistance(lat1, lon1, lat2, lon2) {
            var earthRadiusKm = 6371;
            var dLat = this.degreesToRadians(lat2-lat1);
            var dLon = this.degreesToRadians(lon2-lon1);

            lat1 = this.degreesToRadians(lat1);
            lat2 = this.degreesToRadians(lat2);

            var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                    Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
            
            return earthRadiusKm * c;
        }
    }
    
}
</script>