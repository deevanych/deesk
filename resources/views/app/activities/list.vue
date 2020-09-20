<template>
    <div class="row mb-5 flex-column align-items-start">
        <div class="col-12 block-header">
            <div class="row align-items-center">
                <h3 class="font-weight-bold col flex-grow-0 mb-0 mr-2">Активность</h3>
            </div>
        </div>
        <div class="col block-content timeline">
            <template v-if="activitiesSelf">
                <template v-if="activitiesSelf.length > 0">
                    <ActivityItem :activity="activity" v-for="activity in activitiesSelf" :key="activity.id"/>
                </template>
                <template v-else>
                    Действий не было
                </template>
            </template>
            <template v-else>
                <div class="timeline-item mb-3" v-for="n in 5">
                    <PuSkeleton class="d-block font-weight-bold mb-2 w-100"></PuSkeleton>
                    <PuSkeleton class="d-block text-secondary small mw-80"></PuSkeleton>
                </div>
            </template>
        </div>
        <button v-show="moreButton.show" v-bind:disabled="moreButton.disabled"
                class="mt-3 ml-3 button white p-3 px-4 rounded-pill shadow-sm refresh"
                @click.prevent="changeData">
            Еще
        </button>
    </div>
</template>

<script>
import ActivityItem from "../../../components/activities/ActivityItem";

export default {
    name: 'ActivityList',
    components: {
        ActivityItem
    },
    props: {
        activities: {
            type: Array
        },
        url: {
            type: String
        }
    },
    data: function () {
        return {
            offset: 1,
            moreButton: {
                disabled: false,
                show: true
            },
            activitiesSelf: []
        }
    },
    mounted() {
        this.activitiesSelf = this.activities;
    },
    watch: {
        activities: function (activities) {
            this.activitiesSelf = activities;
        }
    },
    methods: {
        changeData() {
            let self = this,
                url = new URL(window.location.origin + self.url);
            header.loading = true;
            url.searchParams.append('offset', self.offset);
            self.moreButton.disabled = true;
            axios.get(url.href)
                .then(function (response) {
                    header.loading = false;
                    self.offset = self.offset + 1;
                    let activities = response.data.activities;
                    for (let activity in activities) {
                        self.activitiesSelf.push(activities[activity]);
                    }
                    if (activities.length < 5) {
                        self.moreButton.show = false;
                    }
                    self.moreButton.disabled = false;
                });
        },
    }
}
</script>

<style scoped lang="scss">
.timeline {
    border-left: 2px solid;
    margin-left: 1rem;
}
</style>
