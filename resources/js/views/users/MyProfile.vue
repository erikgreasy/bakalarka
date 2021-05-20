<template>
    <div>
            <div class="user-profile">
                <div class="top-section">
                    <div class="user-details">
                        <img v-bind:src="user.avatar_path" alt="profile picture" class="user-avatar">
                        <h3 class="username">
                            
                            {{ user.name }}
                        </h3>
                    </div>
                </div>

            <statistics-tab v-if="user.distance && user.numOfTrips && user.time" :data="[
                {name: 'kilometrov', value: user.distance.toFixed(2)}, 
                {name: 'túr', value: user.numOfTrips}, 
                {name: 'hodín na horách', value: (user.time/3600).toFixed(2)}
            ]"></statistics-tab>

            <div class="container mt-5">

                <wishlist-hills :wishlist="wishlist" />
            
                <section>
                    <div class="section-heading">
                        <h2>Dobrodružstvá</h2>
                    </div>

                    <div v-if="user && user.trips && user.trips.length">
                        <div v-for="trip in user.trips" :key="trip.id">
                            <trip-card :trip="trip"></trip-card>
                        </div>
                    </div>

                    <div v-else>
                        Zatiaľ žiadne dobrodružstvá
                    </div>
                </section>
            </div>

                
            <float-btn v-if="user && user.id == loggedUser.id">
                <li>
                    <router-link :to="'/user/' + user.id + '/edit'">
                        Upraviť profil
                    </router-link>
                </li>
                <li>
                    
                    <a @click="logout" class="logout-link">
                        Logout
                    </a>
                   
                </li>
            </float-btn>
               
                
        </div>
    </div>
</template>

<script>
import StatisticsTab from '../../components/StatisticsTab';
import TripCard from '../../components/TripCard';
import FloatBtn from '../../components/FloatBtn';
import WishlistHills from '../../components/WishlistHills';

export default {
    components: {
        StatisticsTab,
        TripCard,
        FloatBtn,
        WishlistHills
    },
    
    methods: {       
        logout() {
            axios.post('/logout')
                .then(res => {
                    localStorage.removeItem('loggedUser')
                    window.location.replace("/");
                })
        }
    },

    computed: {
        user() {
            return this.$store.getters.getLoggedUser
        },
        loggedUser() {
            return this.$store.getters.getLoggedUser
        },
        wishlist() {
            return this.$store.getters.getWishlist
        }
    },
}
</script>