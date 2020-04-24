<template>
    <div>
        <vue-headful
            title="Главная"
        />
        <issue-list/>
        <client-list/>
    </div>
</template>

<script>
    import IssueList from './issues/list.vue';
    import ClientList from './organizations/list.vue';

    export default {
        path: '/',
        name: 'home',
        components: {
            issueList: IssueList,
            clientList: ClientList
        },
    }
</script>
