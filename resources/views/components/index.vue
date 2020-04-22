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
    import IssueList from 'D:/OSPanel/domains/deesk.ru/resources/views/components/issues/list.vue';
    import ClientList from 'D:/OSPanel/domains/deesk.ru/resources/views/components/organizations/list.vue';

    export default {
        path: '/',
        name: 'home',
        components: {
            issueList: IssueList,
            clientList: ClientList
        },
    }
</script>
