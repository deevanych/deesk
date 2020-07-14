<template>
    <div v-if="this.$user">
        <header-app></header-app>
        <router-view></router-view>
        <scroll-top></scroll-top>
    </div>
</template>

<script>
    import ScrollTop from '../components/scroll-top.vue';
    export default {
        components: {
            scrollTop: ScrollTop,
        },
        data: function () {
            return {
                user: null,
            }
        },
    }
</script>
