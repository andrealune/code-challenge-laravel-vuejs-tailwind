<template>
    <nav class="flex justify-between items-center w-full top-0 left-0 ">
        <div class="logo font-bold text-4xl">CODE CHALLENGE</div>
        <ul class="navigation flex flex-row justify-between">
            <li><a @click="logout()">LOGOUT</a></li>
        </ul>
    </nav> 
</template>

<script>
    export default {
        methods: {
            logout() {
                this.$axios.post('auth/logout')
                .then( resp => {
                    console.log(resp)
                    if (!resp.data.ok) return;
                    this.$store.dispatch('removeToken');
                    this.$router.push('/login')
                }).catch( err => {
                    console.log(err)
                })
            }
        },
    }
</script>

<style lang="css" scoped>
nav
{
    z-index: 1;
    padding: 20px 60px;
    background: rgb(255,250,245);   
    border-bottom: 1px solid #aaa;
}

nav .logo
{
    color: rgb(48,47,81);   
    text-decoration: none;
}

nav ul
{
    gap: 60px;
    list-style: none;
}

nav .navigation li a
{   
    cursor: pointer;
    text-decoration: none;
    color: rgb(48,47,81);
    transition: .5s;
}
nav .navigation li a:hover{
    color: rgb(153, 150, 252);
}
</style>