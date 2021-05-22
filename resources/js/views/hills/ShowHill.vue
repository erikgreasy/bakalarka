<template>

   <div>
       <main class="hill-show">
            <div class="top-section" v-bind:style="{ backgroundImage: 'url(' + hill.thumbnail_path + ')' }">

                <div class="content">

                    <div>
                        <h1>
                            {{ hill.name }}
                        </h1>
                        <p v-if="hill.mountain">
                            {{ hill.mountain.name }}
                        </p>
                    </div>

                        <div class="add-to-wishlist" v-if="inWishlist">
                            <button @click.prevent="removeFromWishlist">
                                <i class="fas fa-star"></i>
                            </button>
                        </div>

                        <div class="add-to-wishlist" v-else>
                            <button @click.prevent="addToWishlist">
                                <i class="far fa-star"></i>
                            </button>
                        </div>

                
                </div>
            </div>

            <statistics-tab :data="[
                {name: 'm.n.m.', value: hill.height},
                {name: 'návštev', value: getNumOfTrips()},
                {name: 'obľúbený', value: hill.favoriteOrder + '.'},
            ]"></statistics-tab>

            <div class="container">

                <div class="hill-tabs">
                    <a href="#" id="showTrips" @click.prevent="showTrips">Návštevy</a>
                    <a href="#" id="showInfo" @click.prevent="showInfo">Info</a>
                </div>
            
                <div class="content-sections">

                    <section id="trips">
                        <div v-if="hill.trips">
                            <div v-for="trip in hill.trips" :key="trip.id">
                                <trip-card :trip="trip"></trip-card>
                            </div>
                        </div>
                        <div v-else>
                            Nepodarilo sa načítať žiadne dobrodružstvá
                        </div>
                        
                    </section>
                    <section id="info">
                        {{ hill.description }}

                        <div class="gallery">
                            <div v-for="img in hill.images" :key="img.id" class="gallery-item">
                                <img :src="img.path">
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <float-btn v-if="online">
                <li>
                    <router-link  :to="{name: 'Track', params: {hill: hill}}">
                        Vyštartovať teraz
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'CreateTrip', params: {hill: hill}}">
                        Pridať záznam túry
                    </router-link>
                </li>
            </float-btn>
        </main>

    </div> 
</template>

<script>
import StatisticsTab from '../../components/StatisticsTab';
import TripCard from '../../components/TripCard';
import FloatBtn from '../../components/FloatBtn';

export default {
    components: {
        StatisticsTab,
        TripCard,
        FloatBtn,
    },
    data() {
        return {
            hill: {},
            inWishlist: false,
            online: true
        }
    },
    methods: {
        getHill() {
            axios.get( '/api/hill/' + this.$route.params.id )
                .then( res => {
                    console.log(res.data)
                    this.hill = res.data.data
                } )
                .catch(err => {
                    // this.$router.push({name: '404'})
                })
        },
        showInfo() {
            $('.content-sections section').hide();
            $('#info').show();
        },
        showTrips() {
            $('.content-sections section').hide();
            $('#trips').show();
        },

        addToWishlist() {
            axios.post('/api/hill/' + this.$route.params.id + '/wishlist')
                .then(res => {
                    this.inWishlist = true
                    this.$store.dispatch('setWishlist')
                })
        },

        removeFromWishlist() {
            axios.delete('/api/hill/' + this.$route.params.id + '/wishlist')
                .then(res => {
                    this.inWishlist = false;
                    this.$store.dispatch('setWishlist')
                })
        },

        isInWishlist() {
            axios.get('/api/hill/' + this.$route.params.id + '/wishlist')
                .then(res => {
                    if(res.data) {
                        this.inWishlist = true
                    }
                })
        },

        getNumOfTrips() {
            if(this.hill.trips) {
                return this.hill.trips.length
            }

            return 0
        }
    },
    created() {
        this.getHill()
        this.isInWishlist()
        if(!navigator.onLine) {
            this.online = false;
        }
    }
    
}
</script>