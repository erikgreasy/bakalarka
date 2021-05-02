<template>
    <main class="trips-index">
        <div class="explore-links">
            <router-link to="/hills">Kopce</router-link>
            <router-link to="/trips">Dobrodružstvá</router-link>
        </div>
    
        <div class="container">
    
            <div class="explore-heading">
                <h3>Najnovšie dobrodružstvá</h3>
                <a href="#" @click.prevent="openFilter"><i class="fas fa-filter fa-2x"></i></a>
            </div>

            <div v-for="trip in trips" :key="trip.id">

                <trip-card :trip="trip"></trip-card>

            </div>

        </div>

        <trips-filter></trips-filter>
    </main>
</template>

<script>
import TripCard from '../../components/TripCard';
import TripsFilter from '../../components/TripsFilter';

export default {
    components: {
        TripCard,
        TripsFilter
    },
    
    data() {
        return {
            trips: []
        }
    },

    methods: {
        getTrips( order = 'newest', hills = [] ) {
            let url = '/api/trips?order=' + order;
            hills.forEach(element => {
                url += '&hills[]=' + element;
            });
            
            axios.get( url )
                .then( data => {
                    this.trips = data.data
                } )
                .catch(err => {
                    console.log(err)
                })
        },
        openFilter() {
            document.querySelector('.filter').classList.add('open')
        }
    },

    created() {
        this.getTrips();
    }
    
}
</script>