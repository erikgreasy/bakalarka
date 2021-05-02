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
                    <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif -->
                    <form enctype="multipart/form-data" @submit.prevent="createTrip">
                
                        <!-- @csrf -->
                
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
                            <label for="thumbnail">Thumbnail:</label>
                            <input id="thumbnail" type="file" name="thumbnail" class="">
                        </div>

                        <div class="form-group">
                            <label for="image">Fotky:</label>
                            <input id="image" type="file" name="image[]" class="" multiple>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Pridať" class="btn btn-primary">
                        </div>
                
                        
                
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
                description: ''
                

            }
        }
    },

    methods: {
        createTrip() {
            axios.post('/api/trips', {
                hill_id: this.hill.id,
                title: this.fields.title,
                date: this.fields.date,
                description: this.fields.description
            })
                .then(res => {
                    this.$router.push( '/trip/' + res.data.id );
                })
                .catch(err => {
                    if( err.response.status == 422 ) {
                        this.errors = err.response.data.errors
                        console.log(this.errors)
                    }
                    
                })
        }
    }
}
</script>