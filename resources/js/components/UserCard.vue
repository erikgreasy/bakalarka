<template>
    <div>
        <router-link :to="{ name: 'ShowUser', params: {id: user.id} }" class="nav-link">
            <article class="user-card">
                <div class="ranking"> 
                    #{{ index }}
                </div>
                <div class="avatar-wrapper">

                    <img v-bind:src="user.avatar_path" alt="">
                </div>
                <div>

                    <h4>
                        {{ user.name }}
                    </h4>
                    <div class="user-stats">

                        <p v-if="user.distance">{{ user.distance.toFixed(2) }}km</p>
                        <p v-if="user.duration">{{ (user.duration/3600).toFixed(2) }} hod</p>
                    </div>
                </div>
                
            </article>
        </router-link>
    </div>
</template>

<script>
export default {
    props: [
        'user',
        'index'
    ],
   
}
</script>