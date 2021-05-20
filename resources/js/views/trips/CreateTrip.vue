<template>
    <div>
        <main class="trip-create">
            <div class="container">
                <header>
                    <h1>
                        Nové dobrodružstvo na {{hill.name}}
                        <router-link :to="'/hill/' + hill.id"  class="close-edit">
                            <i class="fas fa-times"></i>
                        </router-link>
                    </h1>
                </header>
                    <div class="alert alert-danger" v-if="errors">
                        <ul>
                            <li v-for="(error, name) in errors" :key="name">
                                {{ error[0] }}
                            </li>
                        </ul>
                    </div>
                   
                    <form enctype="multipart/form-data" @submit.prevent="createTrip">
                
                        <div class="form-group">
                            <label for="tripTitle">Title:</label>
                            <input type="text" name="title" id="tripTitle" class="form-control" v-model="fields.title">
                        </div>

                        <div class="form-group">
                            <label for="tripDate">Date of the trip: </label>
                            <input type="date" class="form-control" name="date" id="tripDate" v-model="fields.date">
                        </div>
                        <div class="form-group">
                            <input type="hidden" :value="hill.id"  name="hill">
                        </div>
                        
                        <div class="form-group">
                            <label for="tripDesc">Text: </label>
                            <textarea name="description" id="tripDesc" cols="30" rows="5" class="form-control" v-model="fields.description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="thumbnail" v-if="fields.thumbnail"><i class="fas fa-camera"></i>{{ fields.thumbnail.name }}</label>
                            <label for="thumbnail" v-else><i class="fas fa-camera"></i>Nahrať náhľadový obrázok</label>
                            <input id="thumbnail" type="file" ref="file" @change="handleThumbnail()" name="thumbnail" hidden>
                        </div>

                        <div class="form-group">
                            <label for="image">Fotky:</label>
                            <input id="image" type="file" ref="gallery" @change="handleGallery()" name="image[]" class="" multiple>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Pridať" class="btn btn-primary">
                        </div>
                
                        {{gallery}}
                
                    </form>
                </div> <!-- END CONTAINER -->

            </main>
    </div>
</template>

<script>
export default {
    props: ['hill'],
    data() {
        return {
            errors: null,
            fields: {
                title: '',
                date: '',
                description: '',
                thumbnail: null,
            },
            gallery: []
        }
    },

    methods: {
        createTrip() {
            let formData = new FormData();

            formData.append('hill_id', this.hill.id)
            
            // Add all gallery images
            _.each(this.gallery, (value, key) => {
                formData.append('images[' + key + ']', value);

            })

            // Add all the fields to formdata
            _.each(this.fields, (value, key) => {
                formData.append(key, value)
            })

            // Make request to api
            axios.post('/api/trips', formData, 
            {
                headers: {
                    'Content-Type': "multipart/form-data; charset=utf-8;"
                }
            })
                .then(res => {
                    console.log(res)
                    this.$store.dispatch('setTrips')
                    this.$router.push( '/trip/' + res.data.id );
                })
                .catch(err => {
                    if( err.response.status == 422 ) {
                        this.errors = err.response.data.errors
                        console.log(this.errors)
                    }
                    
                })
        },
        
        handleThumbnail() {
            this.fields.thumbnail = this.$refs.file.files[0]
            console.log(this.fields.thumbnail )
        },

        handleGallery() {
            _.each(this.$refs.gallery.files, (value, key) => {
                this.gallery.push(value)
            })
        }
    }
}
</script>