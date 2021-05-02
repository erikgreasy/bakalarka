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
            duration: 0,
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
                    this.trip_id = res.data.id;
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
            
            navigator.geolocation.clearWatch( this.geoIdid )
            
            axios.post('/api/end-trip', {
                trip_id: this.trip_id,
                duration: this.duration,
                distance: this.distance,
            })
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err)
                })
           
            this.$router.push('/trip/' + this.trip_id);
        },

        
        success(pos) {
            console.log('success')

            var crd = pos.coords;
            this.speed = crd.speed * (8/15);

            if(this.lastCoords) {
                this.distance += this.countDistance( this.lastCoords.latitude, this.lastCoords.longitude, crd.latitude, crd.longitude )
            }
            this.lastCoords = crd;

            this.addLog(crd.latitude, crd.longitude, this.speed);
            
        },

        error(err) {
            console.error(err);
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
        },

        addLog(lat, long, speed) {
            axios.post('/api/logs', {
                trip_id: this.trip_id,
                lat: lat,
                long: long,
                speed: speed
            })
                .then(res => {
                    console.log(res)
                })
                .catch(err => {
                    console.error(err)
                })
        }
    }
    
}
</script>