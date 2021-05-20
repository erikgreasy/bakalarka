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
            
                    <div class="form-group">
                        <label for="tripDesc">Popis: </label>
                        <textarea name="description" id="tripDesc" cols="30" rows="5" class="form-control" v-model="trip.description">

                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="thumbnail" v-if="thumbnail"><i class="fas fa-camera"></i>{{ thumbnail.name }}</label>
                        <label for="thumbnail" v-else><i class="fas fa-camera"></i>Nahrať náhľadový obrázok</label>
                        <input id="thumbnail" type="file" ref="file" @change="handleThumbnail()" name="thumbnail" hidden>
                    </div>

                    <div class="form-group">
                        <label for="image">Fotky:</label>
                        <input id="image" type="file" ref="gallery" @change="handleGallery()" name="image[]" class="" multiple>
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
            trip: {},
            remove: false,
            thumbnail: null,
            gallery: []

        }
    },

    methods: {
        getTrip() {
            axios.get( '/api/trip/' + this.$route.params.id )
                .then(data => {
                    this.trip = data.data;
                    this.trip.date = this.trip.date.split(' ')[0]
                })
        },

        submit() {
            let formData = new FormData();

            // Fix for laravel not handling PUT request with multipart, we send post instead with field _method
            formData.append('_method', 'PUT');
            formData.append('title', this.trip.title);
            formData.append('description', this.trip.description);
            formData.append('date', this.trip.date);
            formData.append('thumbnail', this.thumbnail);

            // Add all gallery images
            _.each(this.gallery, (value, key) => {
                formData.append('images[' + key + ']', value);

            })
            
            axios.post( '/api/trip/' + this.$route.params.id, formData, {
                headers: {
                    'Content-Type': "multipart/form-data; charset=utf-8;"
                }
            })
                .then( data => {
                    console.log(data.data)
                    this.$store.dispatch('setTrips')
                    this.$router.push( '/trip/' + this.$route.params.id )
                } )
                .catch(err => {
                    console.log(err.response)
                })
        },
        removeThumbnail() {
            this.remove = true
            document.getElementById('remove-thumbnail').style.display = 'none'
            document.getElementById('trip-thumbnail').style.display = 'none'
            document.getElementById('thumbnail').style.display = 'block'

        },

        handleThumbnail() {
            this.thumbnail = this.$refs.file.files[0]
        },

        handleGallery() {
            _.each(this.$refs.gallery.files, (value, key) => {
                this.gallery.push(value)
            })
        }
    },

    created() {
        this.getTrip()
    }
    
}
</script>