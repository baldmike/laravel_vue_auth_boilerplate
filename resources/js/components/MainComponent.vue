<template>    
    <div class="container">
        <nav-bar></nav-bar>
        <router-view></router-view>
    </div>
</template>

<script>

    import NavBar from './NavBar'

    export default {
        name: "main-app",
        components: {
            NavBar,
        },
    }

</script>