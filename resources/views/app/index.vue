<template>
    <div>
        <vue-headful
            title="Главная"
        />
        <issue-list v-bind:url="'/api/v1/issues'"/>
        <client-list v-if="$type('service')"/>
    </div>
</template>

<script>
    import IssueList from './issues/list.vue';
    import ClientList from './organizations/list.vue';

    export default {
        path: '/',
        name: 'home',
        data: function () {
            return {
                issues: null,
            }
        },
        components: {
            issueList: IssueList,
            clientList: ClientList,
        },
        mounted() {
            header.loading = true;
        }
    }
</script>
