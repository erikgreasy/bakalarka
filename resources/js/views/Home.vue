<template>
    
    <main class="homepage">

        <div class="container">

            <div>
                <h1 class="homepage-title">Ahoj {{ loggedUser.name }}</h1>
                <p class="welcome-line">Kam sa dnes vydáš na dobrodružstvo?</p>
            </div>

            <section class="my-hills">
                <div class="section-heading">
                    <h2>Uložené kopce</h2>

                </div>
                <div class="wishlist-cards" v-if="wishlist.length">
                    <div v-for="hill in wishlist" :key="hill.id">
                        <!-- {{hill}} -->
                        <wishlist-hill :hill="hill"></wishlist-hill>
                    </div>
                </div>
                <div v-else>
                    Zatiaľ žiadne uložené kopce
                </div>
            </section>
            

            <section>
                <div class="section-heading">

                    <h2>Najnovšie dobrodružstvá</h2>
                    <router-link to="/trips">Zobraziť všetky</router-link>
                </div>
                <div v-for="trip in trips" :key="trip.id">

                    <trip-card :trip="trip"></trip-card>
                    
                </div>
            </section>
            <section class="users-ranklist">
                <div class="section-heading">

                    <h2>Rebríček dobrodruhov</h2>
                    <router-link to="/users">Zobraziť všetky</router-link>
                </div>
                <div class="users">

                         <div>
                            <router-link v-if="most_distance" :to="'/user/' + most_distance.id">

                                <article class="user">
                                    <img :src="most_distance.avatar_path">
                                    <h4>
                                        {{ most_distance.name }}
                                    </h4>
                                    <p>Najviac nachodených kilometrov.</p>
                                </article>
                            </router-link>
                         </div>
                        <div>
                            <router-link v-if="most_trips" :to="'/user/' + most_trips.id">

                                <article class="user">
                                    <img :src="most_trips.avatar_path">
                                    <h4>
                                        {{ most_trips.name }}
                                    </h4>
                                    <p>Najviac absolvovaných dobrodružstiev.</p>
                                </article>
                            </router-link>
                        </div>
                        <div>
                            <router-link v-if="most_time" :to="'/user/' + most_time.id">

                                <article class="user">
                                    <img :src="most_time.avatar_path">
                                    <h4>
                                        {{ most_time.name }}
                                    </h4>
                                    <p>Najviac času stráveného na horách.</p>
                                </article>
                            </router-link>
                        </div>

<!-- 
                    <a href="/users/{{ $most_trips->id }}">

                        <article class="user">
                            <img src="{{ $most_trips->avatar_path }}" alt="">
                            <h4>
                                {{ $most_trips->name }}
                            </h4>
                            <p>Najviac absolvovaných dobrodružstiev.</p>
                        </article>
                    </a>

                    <a href="/users/{{ $most_time->id }}">

                        <article class="user">
                            <img src="{{ $most_time->avatar_path }}" alt="">
                            <h4>
                                {{ $most_time->name }}
                            </h4>
                            <p>Najviac času stráveného na horách.</p>
                        </article>
                    </a> -->
                </div>
            </section>
        </div>
    </main>

</template>

<script>
import TripCard from '../components/TripCard';
import WishlistHill from '../components/WishlistHill';

export default {
    components: {
        TripCard,
        WishlistHill,
    },
    data() {
        return {
            wishlist: [],
            most_distance: null,
            most_trips: null,
            most_time: null,
        }
    },

    methods: {
        getTrips() {
            axios.get( '/api/trips' )
                .then(data => {
                    this.trips = data.data
                })
        },

        getWishlist() {
            axios.get('/api/wishlists')
                .then(data => {
                    console.log(data)
                    this.wishlist = data.data
                })
        },
        getTopUsers() {
            axios.get('/api/users/top')
                .then(res => {
                    console.log(res)
                    this.most_distance = res.data.most_distance
                    this.most_trips = res.data.most_trips
                    this.most_time = res.data.most_time

                })
        }
        
        
    },
    computed: {
        loggedUser() {
            return this.$store.getters.getLoggedUser
        },
        trips() {
            return this.$store.getters.allTrips
        },
    },
    created() {
        this.getWishlist()
        this.getTopUsers()
    }
    
}
</script>