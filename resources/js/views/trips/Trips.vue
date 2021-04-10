<template>
    <main class="trips-index">
        <div class="explore-links">
            <router-link to="/hills">Kopce</router-link>
            <router-link to="/trips">Dobrodružstvá</router-link>
        </div>
    
        <div class="container">
    
            <div class="explore-heading">
                <h3>Najnovšie dobrodružstvá</h3>
                <a href="/trips/filter"><i class="fas fa-filter fa-2x"></i></a>
            </div>

            <div v-for="trip in trips" :key="trip.id">

                <trip-card :trip="trip"></trip-card>

            </div>
            <!-- @foreach ($trips as $trip)
                @include('partials.trip-card')
            
            @endforeach -->
        </div>
    </main>
</template>

<script>
import TripCard from '../../components/TripCard';

export default {
    components: {
        TripCard
    },
    data() {
        return {
            trips: []
        }
    },

    methods: {
        getTrips() {
            axios.get( '/api/trips' )
                .then( data => {
                    this.trips = data.data
                } )
                .catch(err => {
                    console.log(err)
                })
        }
    },

    created() {
        this.getTrips();
    }
    
}
</script>