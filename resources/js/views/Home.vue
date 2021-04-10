<template>
    
    <main class="homepage">

        <div class="container">

            <div>
                <h1 class="homepage-title">Ahoj {{ user.name }}</h1>
                <p class="welcome-line">Kam sa dnes vydáš na dobrodružstvo?</p>
            </div>
            <!-- @include('partials.my-hills') -->
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

                    <!-- <a href="/users/{{ $most_distance->id }}">

                        <article class="user">
                            <img src="{{ $most_distance->avatar_path }}" alt="">
                            <h4>
                                {{ $most_distance->name }}
                            </h4>
                            <p>Najviac nachodených kilometrov.</p>
                        </article>
                    </a>

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

export default {
    components: {
        TripCard
    },
    data() {
        return {
            trips: [],
            user: {}
        }
    },

    methods: {
        getTrips() {
            axios.get( '/api/trips' )
                .then(data => {
                    this.trips = data.data
                })
        },
        getLoggedUser() {
            axios.get('/api/current-user')
                .then(data => {
                    if( data.data ) {
                        this.user = data.data
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        },
        
        
    },
    
    created() {
        this.getTrips()
        this.getLoggedUser()
    }
    
}
</script>