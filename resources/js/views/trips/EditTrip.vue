<template>
    <div>
        <main class="trip-edit">
            <div class="container">
                <header>
                    <h1>Upraviť dobrodružstvo
                        <router-link :to="'/trip/' + trip.id" class="close-edit">
                            <i class="fas fa-times"></i>
                        </router-link>
                    </h1>
                </header>
                <form enctype="multipart/form-data" @submit.prevent="submit">

                    <div class="form-group">
                        <label for="tripTitle">Názov:</label>
                        <input type="text" name="title" id="tripTitle" class="form-control" v-model="trip.title">
                    </div>

                    <div class="form-group">
                        <label for="tripDate">Dátum: </label>
                        <input type="date" class="form-control" name="date" id="tripDate" v-model="trip.date">
                    </div>
            
            
                    <!-- {{-- TINY MCE EDITOR, may use in later versions --}}
                    {{-- <textarea name="description" rows="5" cols="40" class="form-control tinymce-editor"></textarea> --}} -->
            
            
                    
                    <div class="form-group">
                        <label for="tripDesc">Popis: </label>
                        <textarea name="description" id="tripDesc" cols="30" rows="5" class="form-control" v-model="trip.description">

                        </textarea>
                    </div>

                    <div class="form-group trip-thumbnail">
                        <label for="thumbnail">Thumbnail:</label>
                        
                        <div class="thumbnail-wrapper">

                            <div>
                                <img :src="trip.thumbnail_path">
                                <a id="remove-thumbnail" class=""><i class="fas fa-times"></i></a>
                            </div>
                            <!-- @if ($trip->thumbnail_path != '/images/image-placeholder.png')
                                <img src="{{ asset($trip->thumbnail_path) }}" alt="" id="trip-thumbnail">
                                <input type="hidden" name="remove_thumbnail" value="false">
                                <input id="thumbnail" type="file" name="thumbnail" class="hide">

                                <a id="remove-thumbnail" class=""><i class="fas fa-times"></i></a>
                            @else
                                <input id="thumbnail" type="file" name="thumbnail" >
        
                            @endif -->
                        </div>

                    </div>

                    <div class="form-group text-center">
                        <input type="submit" value="Upraviť" class="btn btn-primary">
                    </div>
                    
            
                </form>
            </div>
        </main>
        
    </div>
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
                    this.trip = data.data;
                })
        },

        submit() {
            axios.put( '/api/trip/' + this.$route.params.id, {
                title: this.trip.title,
                description: this.trip.description,
                date: this.trip.date
            } )
                .then( data => {
                    console.log(data)
                    this.$router.push( '/trip/' + this.$route.params.id )
                } )
                .catch(err => {
                    console.log(err.response)
                })
        }
    },

    created() {
        this.getTrip()
    }
    
}
</script>