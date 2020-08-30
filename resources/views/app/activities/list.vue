<template>
    <div class="row mb-5 flex-column align-items-start">
        <div class="col-12 block-header">
            <div class="row align-items-center">
                <h3 class="font-weight-bold col flex-grow-0 mb-0 mr-2">Активность</h3>
            </div>
        </div>
        <div class="col block-content timeline">
            <template v-if="activities">
                <template v-if="count > 0">
                    <div class="timeline-item mb-3" v-for="activity in activities">
                        <span class="d-block font-weight-bold" v-html="getActivity(activity)"></span>
                        <span class="d-block text-secondary small" v-html="getDescription(activity)"></span>
                    </div>
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
        <template v-if="count >= 5">
            <button v-bind:disabled="disable"
                    class="mt-3 ml-3 button white p-3 px-4 rounded-pill shadow-sm refresh"
                    @click.prevent="changeData">
                Еще
            </button>
        </template>
    </div>
</template>

<script>
    export default {
        name: 'activities',
        props: ['activities', 'count', 'url', 'type'],
        data: function () {
            return {
                offset: 1,
                disable: false,
            }
        },
        mounted() {
        },
        methods: {
            changeData() {
                let self = this,
                    url = new URL(window.location.origin + self.url);
                header.loading = true;
                url.searchParams.append('offset', self.offset);
                self.disable = true;
                axios.get(url.href)
                    .then(function (response) {
                        header.loading = false;
                        self.offset = self.offset + 1;
                        let activities = response.data.activities;
                        for (let activity in activities) {
                            self.activities.push(activities[activity]);
                        }
                        self.count = (response.data.count !== 0 ? response.data.count : 1);
                        self.disable = false;
                    });
            },
            getActivity(activity) {
                let self = this;
                switch (activity.type) {
                    case 1:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> добавил комментарий к заявке <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a>';
                    case 3:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> сменил статус у заявки <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a> на <span class="status ml-1 ' + activity.issue_status.icon.title + ' ' + activity.issue_status.color.title + '">' + activity.issue_status.title + '</span>';
                    case 4:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> принял заявку <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a>';
                    case 7:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> создал заявку <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a>';
                    case 8:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> сменил ответственного у <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a> на <a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.user.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.user.id}
                        }).href + '\'); return false;">' + activity.user.title + '</a>';
                    case 12:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> удалил заявку <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a>';
                }
            },
            getDescription(activity) {
                let self = this;
                return '<a href="' + self.$router.resolve({
                    name: 'organizations.show',
                    params: {id: activity.author.organization.id}
                }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                    name: 'organizations.show',
                    params: {id: activity.author.organization.id}
                }).href + '\'); return false;">' + activity.author.organization.title + '</a>, ' + self.getFormattedTime(activity.created_at);
            },
        }
    }
</script>
