<template>
    <div class="track">
        <div class="container">
            <div class="destination">
                <p>Cieľ</p>
                <h1>{{ hill.name }}</h1>
            </div>
            <div class="time">
                <p>Uplynutý čas</p>
                <h2 class="time-tracker">{{ padLeadingZeros(hours,2) }}:{{ padLeadingZeros(minutes, 2) }}:{{ padLeadingZeros(seconds,2) }}</h2>
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

            <div v-if="this.trip_id">
                <label for="takePhoto"><i class="fas fa-camera"></i>Zaznamenať fotku</label>
                <input type="file" ref="file" @change="handlePhoto" accept="image/*;capture=camera" id="takePhoto" hidden>

            </div>

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
            seconds: 0,
            minutes: 0,
            hours: 0,
            trip_id: null,
            geoId: null,
            lastCoords: null,
            startTime: null,
            intervalId: null,
            hill: {
                id: 2,
                name: 'asdasd'
            },
            geoOptions: {
                enableHighAccuracy: false,
                timeout: 5000,
                maximumAge: 0
            },
            images: []
        }
    },

    methods: {
        startTrip() {
            document.getElementById('stopTrip').style.display = 'block';
            document.getElementById('startTrip').style.display = 'none';

            this.startTime = performance.now();

            var self = this;
            this.intervalId = setInterval(function() {
                var now = performance.now()
                self.duration = ((now - self.startTime)/1000).toFixed(0)
                var time = self.duration;
                self.hours = (time/3600).toFixed(0);
                time -= (self.hours * 3600);
                self.minutes = (time/60).toFixed(0);
                time -= self.minutes * 60;
                self.seconds = time
            }, 1000)

            axios.post('/api/trips', {
                title: 'Nové dobrodružstvo na  ' + this.hill.name,
                description: 'Zatiaľ žiaden popis',
                hill_id: this.hill.id,
                date: moment().format( 'Y-MM-DD HH:mm:ss' )
            })
                .then(res => {
                    console.log(res)
                    this.$store.dispatch('setTrips')
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
            clearInterval(this.intervalId);
            
            let formData = new FormData();
            formData.append('trip_id', this.trip_id);
            formData.append('duration', this.duration);
            formData.append('distance', this.distance);

            // Add all gallery images
            _.each(this.images, (value, key) => {
                formData.append('images[' + key + ']', value);

            })

            axios.post('/api/end-trip', formData, {
                headers: {
                    'Content-Type': "multipart/form-data; charset=utf-8;"
                }
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
        },
        padLeadingZeros(num, size) {
            var s = num+"";
            while (s.length < size) s = "0" + s;
            return s;
        },
        handlePhoto() {
            this.images.push( this.$refs.file.files[0] )
            document.querySelector('#takePhoto').value = null
            this.$refs.file.files = null;

        }
    },

    created() {
        // Number.prototype.pad = function(size) {
        //     var s = String(this);
        //     while (s.length < (size || 2)) {s = "0" + s;}
        //     return s;
        // }

    }
    
}
</script>