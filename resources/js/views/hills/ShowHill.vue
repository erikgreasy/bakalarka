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
                            <!-- <form action="/userhillwishlist/{{ $userhillwishlist->id }}" method="POST"> -->
                                <!-- @csrf
                                @method( 'DELETE' ) -->
                                <!-- <input type="hidden" name="hill" value="{{ $hill->id }}"> -->
                                <button @click.prevent="removeFromWishlist">
                                    <i class="fas fa-star"></i>
                                </button>
                            <!-- </form> -->
                        </div>

                        <div class="add-to-wishlist" v-else>
                            
                                <button @click.prevent="addToWishlist">
                                    <i class="far fa-star"></i>
                                </button>
                        </div>

                
                </div>
            </div>
            
            <statistics-tab></statistics-tab>

            <div class="container">

                <div class="hill-tabs">
                    <a href="#" id="showTrips" @click.prevent="showTrips">Návštevy</a>
                    <a href="#" id="showInfo" @click.prevent="showInfo">Info</a>
                </div>
            
                <div class="content-sections">

                    <section id="trips">
                        <div v-for="trip in hill.trips" :key="trip.id">
                            <trip-card :trip="trip"></trip-card>
                        </div>
                        
                    </section>
                    <section id="info">
                        {{ hill.description }}

                        <div class="gallery">

                            <!-- @foreach ($hill->images as $img) -->
                                <div class="gallery-item">
                                    <!-- <img src="{{ asset($img->path) }}" alt=""> -->
                                </div>
                                
                            <!-- @endforeach -->
                        </div>
                    </section>
                </div>
            </div>

            <float-btn>
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
            inWishlist: false
        }
    },
    methods: {
        getHill() {
            axios.get( '/api/hill/' + this.$route.params.id )
                .then( data => {
                    this.hill = data.data
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
                })
        },

        removeFromWishlist() {
            axios.delete('/api/hill/' + this.$route.params.id + '/wishlist')
                .then(res => {
                    this.inWishlist = false;
                })
        },

        isInWishlist() {
            axios.get('/api/hill/' + this.$route.params.id + '/wishlist')
                .then(res => {
                    if(res.data) {
                        this.inWishlist = true
                    }
                })
        }
    },
    created() {
        this.getHill()
        this.isInWishlist()
    }
    
}
</script>