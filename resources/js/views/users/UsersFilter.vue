<template>
    
    <aside class="filter">
        <div class="container">

            <header>
                <h1>
                    <!-- {{-- <small class="reset">Reset</small> --}} -->
                    Filter
                    <router-link to="/users" class="close-edit">
                        <i class="fas fa-times"></i>
                    </router-link>
                    <!-- <a href="/users" class="close-edit">
                        <i class="fas fa-times"></i>
                    </a> -->
                </h1>
            </header>

            <form action="/users" method="GET" v-on:submit.prevent="filterUsers">

                <div class="form-group">
                    <h2>Zoradiť od najviac</h2>
                    <div>
                        <input type="radio" id="trips" name="order" value="trips" v-model="order">
                        <label for="trips">Dobrodružstiev</label>
                    </div>
                    <div>
                        <input type="radio" id="distance" name="order" value="distance" v-model="order">
                        <label for="distance">Nachodených kilometrov</label>
                    </div>
                    <div>
                        <input type="radio" id="time" name="order" value="time" v-model="order">
                        <label for="time">Času stráveného na horách</label>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary submit">Aplikovať</button>
                </div>
            </form>
        </div>
    </aside>

</template>

<script>
export default {
    data() {
        return {
            order: 'trips'
        }
    },

    methods: {
        filterUsers() {
            axios.get('/api/users?order=' + this.order)
                .then(data => {
                    console.log(data.data);
                })
        }
    }
}
</script>