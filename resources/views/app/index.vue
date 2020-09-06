<template>
    <div>
        <vue-headful
            title="Главная"
        />
        <metrics-list></metrics-list>
        <issue-list v-bind:url="'/api/v1/issues'"/>
        <div class="row">
            <div class="col-4 mt-2">
                <activity-list
                    :count="count"
                    :activities="activities"
                    :url="'/api/v1/activity'"
                    :type="'organization'"/>
            </div>
            <div class="col-7 offset-1">
                <client-list title="Клиенты" v-if="$type('service')"/>
            </div>
        </div>
    </div>
</template>

<script>
    import IssueList from './issues/list.vue';
    import ClientList from './clients/organizations.vue';
    import ActivityList from "./activities/list";
    import MetricsList from "./metrics/list";

    export default {
        path: '/',
        name: 'home',
        data: function () {
            return {
                issues: null,
                activities: null,
                count: 0,
            }
        },
        components: {
            issueList: IssueList,
            clientList: ClientList,
            activityList: ActivityList,
            metricsList: MetricsList,
        },
        mounted() {
            let self = this;
            header.loading = true;
            axios.get('/api/v1/activity?organization').then(function (response) {
                self.activities = response.data.activities;
                self.count = response.data.count;
            });
        }
    }
</script>
