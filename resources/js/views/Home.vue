<template>
    
    <main class="homepage">
        
        <div class="container">

            <div>
                <h1 class="homepage-title">Ahoj {{ loggedUser.name }}</h1>
                <p class="welcome-line">Kam sa dnes vydáš na dobrodružstvo?</p>
            </div>

            
            <wishlist-hills :wishlist="wishlist" />

            <section>
                <div class="section-heading">

                    <h2>Najnovšie dobrodružstvá</h2>
                    <router-link to="/trips">Zobraziť všetky</router-link>
                </div>
                <div v-for="trip in trips" :key="trip.id">

                    <trip-card :trip="trip"></trip-card>
                    
                </div>
            </section>
            
            <top-users :most_distance="most_distance" :most_trips="most_trips" :most_time="most_time" />

        </div>
    </main>

</template>

<script>
import TopUsers from '../components/TopUsers.vue';
import TripCard from '../components/TripCard';
import WishlistHills from '../components/WishlistHills';

export default {
    components: {
        TripCard,
        WishlistHills,
        TopUsers,
    },
    data() {
        return {
            // wishlist: [],
            most_distance: null,
            most_trips: null,
            most_time: null,
        }
    },

    methods: {
        
        getTopUsers() {
            axios.get('/api/users/top')
                .then(res => {
                    this.most_distance = res.data.most_distance
                    this.most_trips = res.data.most_trips
                    this.most_time = res.data.most_time

                })
        },

        
    },
    computed: {
        loggedUser() {
            return this.$store.getters.getLoggedUser
        },
        trips() {
            return this.$store.getters.allTrips
        },
        wishlist() {
            return this.$store.getters.getWishlist
        }
    },
    created() {
        this.getTopUsers()
    }
    
}
</script>