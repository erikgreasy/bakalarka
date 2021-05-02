<template>
    <div>
        <router-link :to="'/hill/' + hill.id">
            <article class="wishlist-hill-card">
                <img :src="hill.thumbnail_path">

                <div class="info">
                    <h4>{{ hill.name }}</h4>
                    <p class="wishlist-mountain" v-if="hill.mountain">{{ hill.mountain.name }}</p>
                    <p>{{ hill.height }} m.n.m.</p>
                </div>
            </article>
        </router-link>

    </div>
</template>

<script>


export default {
    props: ['hill'],
    data() {
        return {
            
        }
    }
    
}
</script>