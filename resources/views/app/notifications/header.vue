<template>
    <div class="row p-3">
        <perfect class="col block-content m-0" @ps-y-reach-end="changeData" :settings="{wheelPropagation: false}">
            <template v-if="notifications">
                <template v-if="notifications.length > 0">
                    <div class="header-timeline-item" v-on:mouseenter="(!notification.is_read ? markAsRead(notification) : null)"
                         :class="{unread: !notification.is_read}" v-for="notification in notifications">
                        <span class="d-block font-weight-bold" v-html="getActivity(notification.activity)"></span>
                        <span class="d-block text-secondary small"
                              v-html="getDescription(notification.activity)"></span>
                    </div>
                </template>
                <template v-else>
                    Уведомлений нет
                </template>
            </template>
            <template v-else>
                <div class="header-timeline-item mb-3" v-for="n in 5">
                    <PuSkeleton class="d-block font-weight-bold mb-2 w-100"></PuSkeleton>
                    <PuSkeleton class="d-block text-secondary small mw-80"></PuSkeleton>
                </div>
            </template>
        </perfect>
    </div>
</template>

<script>
    export default {
        name: 'notifications',
        props: ['notifications', 'count', 'url', 'type'],
        data: function () {
            return {
                offset: 1,
                disable: false,
                countSelf: 10,
            }
        },
        methods: {
            markAsRead(notification) {
                let self = this;
                axios.put('/api/v1/notifications/' + notification.id, {
                    is_read: true
                })
                    .then(function (response) {
                        notification.is_read = true;
                        self.$emit('readMessage');
                    })
            },
            changeData() {
                let self = this,
                    url = new URL(window.location.origin + self.url),
                    activitiesBlock = document.getElementsByClassName('dropdown-menu activities')[0],
                    visible = (window.getComputedStyle(activitiesBlock, null).getPropertyValue("display") !== 'none');
                if (self.countSelf >= 10 && visible) {
                    header.loading = true;
                    url.searchParams.append('offset', self.offset);
                    self.disable = true;
                    axios.get(url.href)
                        .then(function (response) {
                            header.loading = false;
                            self.offset = self.offset + 1;
                            let notifications = response.data.notifications;
                            for (let notification in notifications) {
                                self.notifications.push(notifications[notification]);
                            }
                            self.countSelf = (response.data.count !== 0 ? response.data.count : 1);
                            self.disable = false;
                        });
                }
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

<style scoped lang="scss">
    .block-content {
        max-height: 300px;
        overflow: auto;
    }

    .header-timeline-item {
        font-size: .8rem;
        border-bottom: 1px solid #eee;
        padding: 1rem;
        transition: background-color 2s;

        &.unread {
            background-color: #fbffde;
        }
    }
</style>
