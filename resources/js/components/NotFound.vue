<template>
    <h1 v-if="$route.name === NotFound">Page Not Found</h1>
</template>

<script>
export default {
    name: 'NotFound'
}
</script>
