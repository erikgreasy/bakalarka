<template>
    <div>
        Login

        <form action="">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">


            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

        </form>
    </div>
</template>

<script>
export default {
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: 'erik.masny@gmail.com',
                    password: 'Erik.masny1999'
                }).then(res => {
                    console.log(res)
                })
            });
        }
    }
}
</script>