<template>
    <div>
        <div id="loading-bar" v-bind:class="{loading: loading}"></div>
        <header class="py-5 mb-5">
            <div class="row">
                <div class="col">
                    <router-link :to="{name: 'home'}" class="logo">
                        <span class="d-block position-absolute w-100 h-100"></span>
                        <img src="/images/logo/logo-small.png"/>
                    </router-link>
                </div>
                <nav class="col-9 d-flex align-items-center justify-content-end">
                    <form class="mr-4 mb-0" id="search">
                        <input type="text" class="p-2 px-4 rounded-pill shadow-sm button" placeholder="поиск .."/>
                    </form>
                    <template v-if="this.$user">
                        <li class="mx-4" v-if="$can('issue.view')">
                            <router-link :to="{name: 'issues.list'}">
                                Заявки
                            </router-link>
                        </li>
                        <li class="mx-4" v-if="$can('settings.view')">
                            <router-link :to="{name: 'settings'}">
                                Настройки
                            </router-link>
                        </li>
                        <li class="ml-4">
                            <button
                                class="button white p-3 rounded-pill shadow-sm dropdown-toggle notification"
                                data-toggle="dropdown"
                                ref="notification"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <span class="notifications-count" v-if="notificationsUnreadCount > 0">{{ getNotificationCount() }}</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-4 activities col-5">
                                <notifications-list :notifications="notifications" :count="count"
                                                    :url="'/api/v1/notifications'"
                                                    :type="'notifications'"
                                                    v-on:readMessage="readMessage"/>
                            </div>
                        </li>
                        <li class="ml-4">
                            <button
                                class="button white p-3 px-4 rounded-pill shadow-sm dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <div v-if="this.$user.profile && this.$user.profile.avatar"
                                     v-bind:style="'background-image: url('+this.$user.profile.avatar+')'"
                                     class="user-avatar mr-3"></div>
                                <div v-else class="user-avatar mr-3"
                                     style="background-image: url(/images/site/avatar_default.gif)"></div>
                                {{ this.$user.title }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <router-link class="dropdown-item"
                                             :to="{ name: 'users.show', params: { id: this.$user.id } }">
                                    <span>Моя страница</span>
                                </router-link>
                                <router-link :to="{name: 'logout'}" class="dropdown-item">
                                    <span>Выйти</span>
                                </router-link>
                            </div>
                        </li>
                    </template>
                    <template v-else>
                        <PuSkeleton v-for="(observer, n) in 3" :key="n" height="18px" width="60px"
                                    class="mx-4"></PuSkeleton>
                    </template>
                </nav>
            </div>
        </header>
    </div>
</template>

<script>
    import * as notification from "../../../animated-icons/bell/bell.json";
    import Notifications from "../notifications/header";

    export default {
        components: {
            notificationsList: Notifications,
        },
        data: function () {
            return {
                loading: false,
                notificationAnimation: null,
                notifications: null,
                count: 0,
                notificationsUnreadCount: 0,
            }
        },
        mounted() {
            let self = this;
            self.notificationAnimation = lottie.loadAnimation({
                container: self.$refs.notification,
                autoplay: false,
                name: 'notification',
                animationData: notification.default
            });
            window.header = this;
            this.loading = false;
            axios.get('/api/v1/notifications').then(function (response) {
                self.notificationsUnreadCount = response.data.unreadCount;
                self.notifications = response.data.notifications;
                self.count = response.data.count;
            });
            let channel = pusher.subscribe('notifications-' + this.$user.id);
            channel.bind('notificationAdded', function (data) {
                self.newNotification(data);
            });
        },
        beforeDestroy() {
            let self = this;
            if (self.issue) {
                pusher.unsubscribe('notifications-' + this.$user.id);
            }
        },
        methods: {
            newNotification(data) {
                let self = this,
                    audio = new Audio('/sounds/notification.mp3');
                self.notificationsUnreadCount++;
                self.notifications.unshift(data.notification);
                self.notifications.pop();
                self.notificationAnimation.stop();
                self.notificationAnimation.play();
                audio.play();
            },
            getNotificationCount() {
                let self = this;
                return (self.notificationsUnreadCount >= 10 ? '9+' : self.notificationsUnreadCount);
            },
            readMessage() {
                let self = this;
                if (self.notificationsUnreadCount === 0) {
                    return false;
                }
                self.notificationsUnreadCount--;
            }
        }
    }
</script>

<style scoped lang="scss">
    .notification::v-deep {
        position: relative;

        &:after {
            content: none;
        }

        svg {
            width: 1.5rem !important;
        }

        .notifications-count {
            position: absolute;
            background: #dc3545;
            color: #fff;
            width: 1.2rem;
            height: 1.2rem;
            font-size: 0.8rem;
            line-height: 1.2rem;
            border-radius: 100%;
            z-index: 1;
            right: 0;
            top: 0;
        }
    }
</style>
