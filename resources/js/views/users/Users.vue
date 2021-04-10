<template>

    <main class="users-index">
        <div class="container">
            <div class="users-page">
                <div class="explore-heading">
                    <!-- <h3>{{ $order_text }}</h3> -->
                    <h3>Zatial nic</h3>

                    <a href="#" @click="openFilter">
                        <i class="fas fa-filter fa-2x"></i>
                    </a>
                </div>
                <h3></h3>
            </div>
            <div class="users-ranklist" v-for="(user, index) in users" :key="user.id">

                <user-card :user="user" :index="index + 1"></user-card>
    
            </div>
        
        </div>

        <users-filter></users-filter>
    </main>

</template>

<script>
import UserCard from '../../components/UserCard';
import UsersFilter from '../../components/UsersFilter';

export default {
    components: {
        UserCard,
        UsersFilter
    },
    data() {
        return {
            users: []
        }
    },
    methods: {
        getUsers( order = 'trips' ) {
            axios.get('/api/users?order=' + order)
                .then(data => {
                    this.users = data.data
                })
                .catch(err => {
                    console.log(err)
                })
        },
        openFilter() {
            document.querySelector('.filter').classList.add('open')
        }
    },
    created() {
        this.getUsers();
    }
}
</script>