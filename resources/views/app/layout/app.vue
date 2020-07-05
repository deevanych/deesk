<template>
    <div v-if="this.$user">
        <header-app></header-app>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                user: null,
            }
        },
    }
</script>
