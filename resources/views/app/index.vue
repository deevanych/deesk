<template>
    <div>
        <vue-headful
            title="Главная"
        />
        <issue-list v-bind:issues="issues"/>
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
            clientList: ClientList
        },
        mounted() {
            let self = this;
            axios.get('/api/v1/issues')
                .then(function (response) {
                    self.issues = response.data;
                    header.loading = false;
                });
            header.loading = true;
        }
    }
</script>
