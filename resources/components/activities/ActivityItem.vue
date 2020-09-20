<template>
    <div class="timeline-item mb-3">
        <span class="d-block font-weight-bold" v-html="getActivity"></span>
        <span class="d-block text-secondary small" v-html="getDescription"></span>
    </div>
</template>

<script>
    export default {
        name: 'ActivityItem',
        props: {
            activity: {
                type: Object
            }
        },
        data: function() {
            return {
                $router: this.$router,
            }
        },
        computed: {
            getActivity: function () {
                let self = this,
                    activity = self.activity;
                switch (activity.type) {
                    case 1:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> добавил комментарий к заявке <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a>';
                    case 3:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> сменил статус у заявки <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a> на <span class="status ml-1 ' + activity.issue_status.icon.title + ' ' + activity.issue_status.color.title + '">' + activity.issue_status.title + '</span>';
                    case 4:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> принял заявку <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a>';
                    case 7:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> создал заявку <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a>';
                    case 8:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> сменил ответственного у <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a> на <a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.user.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.user.id}
                        }).href + '\'); return false;">' + activity.user.title + '</a>';
                    case 12:
                        return '<a href="' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'users.show',
                            params: {id: activity.author.id}
                        }).href + '\'); return false;">' + activity.author.title + '</a> удалил заявку <a href="' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '" onclick="router.push(\'' + self.$router.resolve({
                            name: 'issues.show',
                            params: {id: activity.issue.id}
                        }).href + '\'); return false;">' + activity.issue.title + ' (#' + activity.issue.id + ')</a>';
                }
            },
            getDescription: function() {
                let self = this,
                    activity = self.activity;
                return '<a href="' + self.$router.resolve({
                    name: 'organizations.show',
                    params: {id: activity.author.organization.id}
                }).href + '" onclick="router.push(\'' + self.$router.resolve({
                    name: 'organizations.show',
                    params: {id: activity.author.organization.id}
                }).href + '\'); return false;">' + activity.author.organization.title + '</a>, ' + self.getFormattedTime(activity.created_at);
            },
        }
    }
</script>

<style scoped lang="scss">

.timeline-item {
    &:before {
        content: '';
        background-image: url('/images/statuses/dot.svg');
        width: 1rem;
        height: 1.65rem;
        display: block;
        background-color: #fff;
        position: absolute;
        background-size: 1rem;
        left: -0.6rem;
        background-position: center;
        background-repeat: no-repeat;
    }

    &:last-of-type {
        margin-bottom: 0 !important;
    }
}
</style>
