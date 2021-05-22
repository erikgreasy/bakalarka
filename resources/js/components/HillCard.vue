<template>
    <div>
        <router-link :to="{ name: 'ShowHill', params: {id: hill.id} }" class="nav-link">
            <article class="card">
                <div class="image">
                    <img v-bind:src="hill.thumbnail_path" alt="">
                </div>
                <div>

                    <h4>
                        {{ hill.name }}
                    </h4>
                    <p>
                        {{ hill.height }} m.n.m.
                    </p>
                    <p class="description">
                        {{ hill.description.substring(0, 100) }}...
                    </p>
                </div>
                
            </article>
        </router-link>

    </div>
</template>

<script>
export default {
    props: [
        'hill'
    ]
    
}
</script>