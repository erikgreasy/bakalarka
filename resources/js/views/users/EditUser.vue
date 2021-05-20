<template>
    <div class="user-edit">
        <div class="container">
            <header>
                <h1>Nastavenia profilu
                    <router-link :to="'/user/' + user.id" class="close-edit">
                        <i class="fas fa-times"></i>
                    </router-link>
                </h1>
                
            </header>

            <div class="alert alert-danger" v-if="errors.length">
                <ul>
                    <li v-for="error in errors" >
                        {{ error }}
                    </li>
                </ul>
            </div>

            <form @submit.prevent="update" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="form-group">
                        <label for="name">Meno:</label>
                        <input type="text" name="name" id="name" v-model="user.name" class="form-control">
                    </div>
           
                    <!-- <div class="form-group">
                        <label for="avatar">Profile pic:</label>
                        <input type="file" ref="file" @change="handleAvatar()" name="avatar" id="avatar">
                    </div> -->
                    
                    <div class="form-group">
                        <label for="avatar" v-if="avatar"><i class="fas fa-camera"></i>{{ avatar.name }}</label>
                        <label for="avatar" v-else><i class="fas fa-camera"></i>Nahrať nový avatar</label>
                        <input id="avatar" type="file" ref="file" @change="handleAvatar()" name="avatar" hidden>
                    </div>
                 
                </div>
        
                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
        
        
            </form>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            user: {},
            errors: [],
            avatar: null
        }
    },

    methods: {
        getUser() {
            axios.get( '/api/user/' + this.$route.params.id )
                .then(data => {
                    this.user = data.data.data

                })
                .catch(err => {
                    this.$router.push('/')
                })
        },

        update() {
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('name', this.user.name);
            formData.append('avatar', this.avatar);

            axios.post( '/api/user/' + this.$route.params.id, formData, {
                headers: {
                    'Content-Type': "multipart/form-data; charset=utf-8;"
                }
            })
                .then(res => {
                    console.log(res)
                    this.$store.dispatch('setUsers')
                    this.$store.dispatch('setLoggedUser')

                    this.$router.push( '/user/' + this.$route.params.id )

                })
                .catch(err => {
                    if( err.response.status == 422 ) {
                        this.errors = err.response.data.errors.name
                    }
                    console.log(err.response)
                })

        },
        handleAvatar() {
            this.avatar = this.$refs.file.files[0]
        }

    },

    created() {
        this.getUser()
    }
    
}
</script>