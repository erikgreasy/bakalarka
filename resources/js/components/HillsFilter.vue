<template>
    
    <aside class="filter">
        <div class="container">

            <header>
                <h1>
                    <!-- {{-- <small class="reset">Reset</small> --}} -->
                    Filter


                    <a href="#" @click="closeFilter" class="close-edit">
                        <i class="fas fa-times"></i>
                    </a>
                </h1>
            </header>

            <form action="/hills" method="GET" v-on:submit.prevent="filterHills">

                <div class="form-group">
                    <h2>Zoradiť od</h2>

                    <input type="radio" id="male" name="order" value="newest" v-model="order">
                    <label for="male">Najnovšie</label>

                    <input type="radio" id="female" name="order" value="highest" v-model="order">
                    <label for="female">Najvyššie</label>

                    <input type="radio" id="other" name="order" value="other" v-model="order">
                    <label for="other">Najobľúbenejšie</label>
                </div>
                <div class="form-group">
                    <h2>Pohoria</h2>

                    <div v-for="mountain in mountains" :key="mountain.id">
                        <div>
                            <input type="checkbox" :id="'moutain_' + mountain.id" name="mountains[]" :value="mountain.id" v-model="selectedMountains">
                            <label :for="'moutain_' + mountain.id">{{ mountain.name }}</label>
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
            mountains: [],
            selectedMountains: []
        }
    },

    methods: {
        getMountains() {
            axios.get( '/api/mountains' )
                .then(data => {
                    this.mountains = data.data;
                })
        },

        filterHills() {
            console.log(this.order);
            this.$parent.getHills( this.order, this.selectedMountains );
            this.closeFilter()
        },
        closeFilter() {
            document.querySelector('.filter').classList.remove('open')
        }
    },

    created() {
        this.getMountains()
    }
}
</script>