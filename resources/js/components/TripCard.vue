<template>
    <div>
        <router-link :to="{ name: 'ShowTrip', params: {id: trip.id} }" class="nav-link">
            <article class="card">

                <div class="image">
                    
                    <img v-bind:src="trip.thumbnail_path" alt="">

                </div>
                <div>

                    <h4>

                        {{ trip.title }}
                    </h4>
                    <p>
                        <!-- {{ $trip->hill->name }} -->
                    </p>
                    <p class="description">
                        {{ trip.description }}
                        <!-- {{ Str::limit( $trip->description, 80 ) }} -->
                    </p>
                </div>
            
            </article>
        </router-link>
    </div>
    
</template>

<script>
export default {
    props: ['trip']
    
}
</script>