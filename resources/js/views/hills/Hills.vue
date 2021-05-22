<template>
    <main class="hills-index">
        <div class="explore-links">
            <router-link to="/hills">Kopce</router-link>
            <router-link to="/trips">Dobrodružstvá</router-link>
        </div>

        <div class="container">
            <div class="explore-heading">
                <h3>Najpopulárnejšie kopce</h3>
                <a href="#" @click="openFilter">
                    <i class="fas fa-filter fa-2x"></i>
                </a>
            </div>

            <div v-if="!filter">
                <div v-for="hill in hills" :key="hill.id">
                    <hill-card :hill="hill"></hill-card>
                </div>
            </div>
            <div v-else>
                <div v-for="hill in filteredHills" :key="hill.id">
                    <hill-card :hill="hill"></hill-card>
                </div>
                <p v-if="!filteredHills.length">
                    Žiadne kopce nevyhovujú kritériam
                </p>
            </div>

        </div>

        <hills-filter></hills-filter>
    </main>
        
</template>

<script>
import HillCard from './../../components/HillCard';
import HillsFilter from '../../components/HillsFilter';

export default {
    components: {
        HillCard,
        HillsFilter,
    },
    data() {
        return {
            filteredHills: [],
            filter: false
        }
    },
    methods: {
        getHills( order = 'newest', mountains = [] ) {
            let url = '/api/hills?order=' + order;
            mountains.forEach(element => {
                url += '&mountains[]=' + element;
            });
            axios.get(url)
                .then( data => {
                    this.filter = true
                    this.filteredHills = data.data;
                } )
                .catch(err => {
                    console.log(err)
                })
        },
        openFilter() {
            document.querySelector('.filter').classList.add('open')
        }
    },

    computed: {
        hills() {
            return this.$store.getters.allHills
        }
    },

    created() {
        // this.getHills()
    }
}
</script>