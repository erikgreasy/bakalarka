<template>
    
    <main class="trip-detail">

        <div class="trip-thumbnail">
            <img v-bind:src="trip.thumbnail_path" alt="">
            
        </div>
        <div>
            <div class="container">

                <h2>{{ trip.title }}</h2>
                <p class="trip-user">{{ trip.user.name }}</p>
                <div class="trip-stats">
                    <div>
                        <i class="fas fa-map-marker-alt"></i>
                        {{ trip.hill.name }}
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
            <!-- @foreach( $trip->images as $image )
                <img src="{{ $image->path }}" alt="">
                
            @endforeach -->
        </div>
    </main>

    <!-- <x-floating_btn>

        <li>
            <a href="/trips/{{ $trip->id }}/edit">
                Upraviť trip
            </a>
        </li>
        <li>
            <a href="javascript:void" onclick="$('#delete-form').submit();" class="logout-link">
                Odstrániť trip
            </a>
            
            <form id="delete-form" action="/trips/{{ $trip->id }}" method="POST" style="display: none;">
                @method('DELETE')
                @csrf
            </form>
        </li>

    </x-floating_btn> -->

</template>


<script>
export default {
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
        }
    },
    created() {
        this.getTrip()
    }
}
</script>