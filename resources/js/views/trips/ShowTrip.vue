<template>
    <div>
        <main class="trip-detail">
            <div class="trip-thumbnail">
                <img v-bind:src="trip.thumbnail_path" alt="">
                
            </div>
            <div>
                <div class="container">

                    <h2>{{ trip.title }}</h2>
                    <router-link v-if="trip.user" :to="'/user/' + trip.user.id" class="trip-user">{{ trip.user.name }}</router-link>
                    <div class="trip-stats">
                        <div v-if="trip.hill">
                            <i class="fas fa-map-marker-alt"></i>
                            <router-link v-if="trip.hill" :to="'/hill/' + trip.hill.id">
                                {{ trip.hill.name }}
                            </router-link>
                        </div>
                        <div>
                            <i class="far fa-calendar"></i>
                            {{ trip.date }}
                        </div>
                        
                        <div v-if="trip.distance">
                            <i class="fas fa-hiking"></i>
                            {{ trip.distance }} km
                        </div>

                        <div v-if="trip.duration">
                            <div>
                                <i class="far fa-clock"></i>
                                {{ trip.duration }} s
                            </div>
                        </div>

                    </div>
                    <p class="trip-desc">

                        {{ trip.description  }}
                    </p>
                </div>
            </div>
            <div class="trip-images">
                <img v-for="img in trip.images" :key="img.id" :src="img.path" >
            </div>
        </main>

        <float-btn v-if="trip.user.id == loggedUser.id">
            <li>
                <router-link :to="'/trip/' + trip.id + '/edit'">
                    Upraviť trip
                </router-link>
            </li>
            <li>
                <a href="#" @click="deleteTrip" class="logout-link">
                    Odstrániť trip
                </a>
            </li>
        </float-btn>

    </div>

</template>


<script>
import FloatBtn from '../../components/FloatBtn';

export default {
    components: {
        FloatBtn
    },
    data() {
        return {
            trip: {}
        }
    },
    methods: {
        getTrip() {
            axios.get( '/api/trip/' + this.$route.params.id )
                .then(data => {
                    this.trip = data.data
                })
                .catch(err => {
                    console.log(err);
                })
        },
        deleteTrip() {
            axios.delete( '/api/trip/' + this.trip.id )
                .then(data => {
                    this.$store.dispatch('setTrips')
                    this.$router.push( '/' );
                })
        }
    },
    computed: {
        loggedUser() {
            return this.$store.getters.getLoggedUser
        }
    },
    created() {
        this.getTrip()
    }
}
</script>