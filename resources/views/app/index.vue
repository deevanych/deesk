<template>
    <div>
        <vue-headful
            title="Главная"
        />
        <metrics-list></metrics-list>
        <issue-list v-bind:url="'/api/v1/issues'"/>
        <div class="row">
            <div class="col-6">
                <activity-list v-bind:url="'/api/v1/activity'"
                               v-bind:type="'organization'"/>
            </div>
            <div class="col-6">
                <client-list v-if="$type('service')"/>
            </div>
        </div>
    </div>
</template>

<script>
    import IssueList from './issues/list.vue';
    import ClientList from './organizations/list.vue';
    import ActivityList from "./activities/list";
    import MetricsList from "./metrics/list";

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
            activityList: ActivityList,
            metricsList: MetricsList,
        },
        mounted() {
            header.loading = true;
        }
    }
</script>
