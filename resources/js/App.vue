<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="desktopNavbar">
            <router-link to="/" class="navbar-brand">
                Turista
            </router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Domov</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/hills">Kopce</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" to="/trips">Dobrodružstvá</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/users">Rebriček dobrodruhov</router-link>
                    </li>
                </ul>
                <ul class="ml-auto navbar-nav">

                    <li class="nav-item">
                        <!-- @auth -->
                            <router-link class="nav-link" v-bind:to="'/user/' + user.id">{{ user.name }}</router-link>
                        <!-- @endauth -->
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="mobile-navigation-bar">
            <ul>
                <li>
                    <router-link to="/" class="nav-link"><i class="fas fa-home"></i></router-link>
                </li>
                <li>
                    <router-link to="/hills" class="nav-link">
                        <i class="fas fa-mountain"></i>
                    </router-link>

                </li>
                <li>
                    <router-link to="/users" class="nav-link">
                        <i class="fas fa-user-friends"></i>
                    </router-link>
                </li>
                <li>
                    <router-link v-bind:to="'/user/' + user.id" class="nav-link">
                        <i class="fas fa-user"></i>
                    </router-link>
                </li>
            </ul>
        </nav>

        <div>
            <transition name="slide" mode="out-in">
                <router-view/>
            </transition>
        </div>
   </div>
</template>

<script>
export default {
    data() {
        return {
            user: {}
        }
    },
    methods: {
        getLoggedUser() {
            axios.get('/api/user')
                .then(data => {
                    if( data.data ) {
                        this.user = data.data
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },
    created() {
        this.getLoggedUser()
        this.$store.dispatch('setLoggedUser')
        this.$store.dispatch('setUsers')
    }
}
</script>

<style scoped>
.slide-enter-active,
.slide-leave-active {
    transition: opacity .5s, transform .5s;
}

.slide-enter,
.slide-leave-to {
    opacity: 0;
    transform: translateX(50%);
}
</style>