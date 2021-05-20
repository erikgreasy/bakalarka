<template>
    
    <aside class="filter">
        <div class="container">

            <header>
                <h1>
                    Filter

                    <a href="#" @click="closeFilter" class="close-edit">
                        <i class="fas fa-times"></i>
                    </a>
                </h1>
            </header>

            <form method="GET" @submit.prevent="filterTrips">

                <div class="form-group">
                    <h2>Zoradiť od</h2>

                    <input type="radio" id="newest" name="order" value="newest" v-model="order">
                    <label for="newest">Najnovšie</label>

                    <input type="radio" id="longest" name="order" value="longest" v-model="order">
                    <label for="longest">Najdlhšie</label>

                    <!-- <input type="radio" id="female" name="order" value="highest" v-model="order">
                    <label for="female">Najvyššie</label>

                    <input type="radio" id="other" name="order" value="other" v-model="order">
                    <label for="other">Najobľúbenejšie</label> -->
                </div>
                <div class="form-group">
                    <h2>Kopce</h2>

                    <div v-for="hill in hills" :key="hill.id">
                        <div>
                            <input type="checkbox" :id="'hill_' + hill.id" name="hills[]" :value="hill.id" v-model="selectedHills">
                            <label :for="'hill_' + hill.id">{{ hill.name }}</label>
                        </div>
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
            order: 'newest',
            hills: [],
            selectedHills: []
        }
    },

    methods: {
        getHills() {
            axios.get( '/api/hills' )
                .then(data => {
                    this.hills = data.data;
                })
        },

        filterTrips() {
            console.log(this.order);
            this.$parent.getTrips( this.order, this.selectedHills );
            this.closeFilter()
        },
        closeFilter() {
            document.querySelector('.filter').classList.remove('open')
        }
    },

    created() {
        this.getHills()
    }
}
</script>