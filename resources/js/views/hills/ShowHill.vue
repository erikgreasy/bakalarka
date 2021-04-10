<template>

   <div>

       <main class="hill-show">
        <div class="top-section" v-bind:style="{ backgroundImage: 'url(' + hill.thumbnail_path + ')' }">

            <div class="content">

                <div>
                    <h1>
                        {{ hill.name }}
                    </h1>
                    <p>
                        {{ hill.mountain.name }}
                    </p>
                </div>

                <!-- @if( $userhillwishlist ) -->
                    <div class="add-to-wishlist">
                        <!-- <form action="/userhillwishlist/{{ $userhillwishlist->id }}" method="POST"> -->
                            <!-- @csrf
                            @method( 'DELETE' ) -->
                            <!-- <input type="hidden" name="hill" value="{{ $hill->id }}"> -->
                            <button type="submit">
                                <i class="fas fa-star"></i>
                            </button>
                        <!-- </form> -->
                    </div>
                <!-- @else -->
                    <div class="add-to-wishlist">
                        <!-- <form action="/userhillwishlist" method="POST">
                            @csrf
                            <input type="hidden" name="hill" value="{{ $hill->id }}">
                            <button type="submit">
                                <i class="far fa-star"></i>
                            </button>
                        </form> -->
                    </div>
                <!-- @endif -->

               
            </div>
        </div>
        
        <!-- @include( 'partials.statistics-tab' ) -->
        <statistics-tab></statistics-tab>

        <div class="container">

            <div class="hill-tabs">
                <a href="#" id="showTrips">Návštevy</a>
                <a href="#info" id="showInfo">Info</a>
                <!-- {{-- <a href="#ranking" id="showRanking">Rebríček</a> --}} -->
            </div>
        
            <div class="content-sections">

                <section id="trips">
                    <div v-for="trip in hill.trips" :key="trip.id">
                        <trip-card :trip="trip"></trip-card>
                    </div>
                    
                    <!-- {{-- <a href="/trips/create" class="btn btn-info">
                        create trip
                    </a> --}}
                    {{-- <a href="/hills/{{ $hill->id }}/track" class="btn btn-danger">
                        Start Trip
                    </a> --}} -->
            
                    
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
                <!-- {{-- <section id="ranking">
                    toto je ranking
                </section> --}} -->
            </div>


            
        
            
        </div>
    </main>

    <!-- <x-floating_btn>

        <li>
            <a href="/hills/{{$hill->id}}/track">
                Vyštartovať teraz
            </a>
        </li>
        <li>
            <a href="/trips/create">
                Pridať záznam túry
            </a>
        </li>
    </x-floating_btn> -->
    </div> 
</template>

<script>
import StatisticsTab from '../../components/StatisticsTab';
import TripCard from '../../components/TripCard';

export default {
    components: {
        StatisticsTab,
        TripCard
    },
    data() {
        return {
            hill: {}
        }
    },
    methods: {
        getHill() {
            axios.get( '/api/hill/' + this.$route.params.id )
                .then( data => {
                    this.hill = data.data
                } )
                .catch(err => {
                    this.$router.push({name: '404'})
                })
        }
    },
    created() {
        this.getHill()
    }
    
}
</script>