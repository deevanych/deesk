<template>
    <div class="row mb-4" v-if="issue">
        <div class="col-7">
            <vue-headful
                v-bind:title="issue.title"
            />
            <div class="row mb-2">
                <div class="col">
                    <h1 class="font-weight-bolder mb-4 d-flex align-items-center">
                        <a class="back-link d-flex align-items-center" v-on:click="router.go(-1)">
                            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="long-arrow-alt-left"
                                 role="img"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                 class="svg-inline--fa fa-long-arrow-alt-left fa-w-14 fa-3x mr-4 flex-shrink-0"
                                 width="30">
                                <path fill="currentColor"
                                      d="M107.515 150.971L8.485 250c-4.686 4.686-4.686 12.284 0 16.971L107.515 366c7.56 7.56 20.485 2.206 20.485-8.485v-71.03h308c6.627 0 12-5.373 12-12v-32c0-6.627-5.373-12-12-12H128v-71.03c0-10.69-12.926-16.044-20.485-8.484z"
                                      class=""></path>
                            </svg>
                            {{ issue.title }}
                        </a>
                    </h1>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col d-flex align-items-center justify-content-end">
                    <button class="button rounded-pill fave mr-auto p-4 shadow-sm" :class="{remove: issue.favorite}"
                            :disabled="disabled.favorite"
                            v-on:click="toggleFavorite(issue.id, issue.favorite)"></button>
                    <template v-if="$type('service') && !issue.isTrashed">
                        <template v-if="!issue.employee">
                            <button href="/"
                                    class="button p-3 px-4 rounded-pill shadow-sm white router-link-exact-active router-link-active"
                                    v-on:click.prevent="acceptIssue" :disabled="disabled.accept">
                                Принять
                            </button>
                        </template>
                        <template v-else>
                            <a href="/"
                               class="button p-3 px-4 rounded-pill shadow-sm white router-link-exact-active router-link-active"
                               v-if="checkEmployee(issue)"
                               data-toggle="modal" data-target="#transferIssue">
                                Передать
                            </a>
                        </template>
                    </template>
                    <span v-if="issue.isTrashed" class="text-gray">Заявка удалена</span>
                    <button
                        class="ml-3 button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active"
                        v-bind:class="[issue.status.color.title, {'dropdown-toggle': !issue.isTrashed}]"
                        data-color="white"
                        aria-haspopup="true"
                        data-toggle="dropdown"
                        aria-expanded="false"
                        :disabled="disabled.status">
                            <span class="status white"
                                  v-bind:class="issue.status.icon.title">
                                {{ issue.status.title }}
                            </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" v-if="!issue.isTrashed">
                        <a @click="changeStatus(status)" class="dropdown-item status white" v-for="status in statuses">
                            <span class="status"
                                  v-bind:class="[status.icon.title, status.color.title]">
                                {{ status.title }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <span v-html="issue.description"></span>
                </div>
            </div>
            <comments :comments="comments" :showSendForm="!issue.isTrashed"></comments>
        </div>
        <div class="col-4 offset-1">
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Дата создания</h6>
                    <h5>{{ getFormattedTime(issue.created_at) }}</h5>
                </div>
            </div>
            <div class="row mb-4" v-if="issue.updated_at">
                <div class="col">
                    <h6 class="text-gray">Дата обновления</h6>
                    <h5>{{ getFormattedTime(issue.updated_at) }}</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray d-flex align-items-center">Автор
                        <span v-if="issue.service_created"
                              data-toggle="tooltip"
                              data-placement="top"
                              data-html="true"
                              class="notification ml-2"
                              data-original-title="Заявка создана сервисной организацией от имени автора">
                        </span>
                    </h6>
                    <user-info v-if="issue.author" v-bind:users="issue.author"></user-info>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Ответственный</h6>
                    <user-info v-if="issue.employee" v-bind:users="issue.employee"></user-info>
                    <h5 v-else>Не назначен</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Тип заявки</h6>
                    <h5 v-if="issue.type">{{ issue.type.title }}</h5>
                    <h5 v-else="issue.type">Не назначен</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Приоритет заявки</h6>
                    <h5 v-if="issue.priority">{{ issue.priority.title }}</h5>
                    <h5 v-else="issue.priority">Не назначен</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Наблюдатели</h6>
                    <div class="d-flex align-items-center" v-if="issue.observers">
                        <user-info v-if="issue.observers.length > 0" v-bind:users="issue.observers"></user-info>
                        <template v-else>
                            <h5>Наблюдателей нет</h5>
                        </template>
                    </div>
                    <h5 v-else>Наблюдателей нет</h5>
                </div>
            </div>
            <ActivityList :activities="activities"
                          :url="'/api/v1/activity?issue=' + this.$route.params.id"/>

            <div class="row mb-4" v-if="!issue.isTrashed">
                <div class="col">
                    <button href="/"
                            class="button p-3 px-4 rounded-pill shadow-sm red router-link-exact-active router-link-active"
                            :disabled="disabled.remove" data-toggle="modal" data-target="#removeIssue">
                        Удалить заявку
                    </button>
                </div>
            </div>
        </div>

        <!--        modal-->
        <form class="modal fade"
              ref="editForm" id="transferIssue"
              tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
              v-on:submit.prevent="transferIssue" v-if="!issue.isTrashed">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5 m-0">
                    <div class="modal-header px-0 pt-0 pb-4 border-0">
                        <h5 class="modal-title">Передать заявку</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="form">
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Сотрудник</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="employee_id"
                                        v-bind="{values: employees, name: 'employee_id', nullable: true, nullTitle: 'Выберите сотрудника'}"></select2>
                                </div>
                            </div>
                        </div>
                        <div class="annotations mb-3">
                            <small><span class="text-danger">*</span> - поля, обязательные для заполнения</small>
                        </div>
                    </div>
                    <div class="modal-footer p-0">
                        <button data-dismiss="modal"
                                class="button p-3 px-4 rounded-pill shadow-sm white"
                                :disabled="disabled.transfer">
                            Отмена
                        </button>
                        <button
                            type="submit"
                            class="ml-3 button p-3 px-4 rounded-pill shadow-sm tonight green"
                            :disabled="disabled.transfer">
                            Передать
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <form class="modal fade" id="removeIssue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true" v-on:submit.prevent="removeIssue">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5 m-0">
                    <div class="modal-header px-0 pt-0 pb-4 border-0">
                        <h5 class="modal-title">Удаление заявки</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        Удалить заявку?
                    </div>
                    <div class="modal-footer p-0">
                        <button data-dismiss="modal"
                                class="button p-3 px-4 rounded-pill shadow-sm white">
                            Отмена
                        </button>
                        <button
                            type="submit"
                            class="ml-3 button p-3 px-4 rounded-pill shadow-sm tonight red"
                            :disabled="disabled.remove">
                            Да, удалить
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row mb-4" v-else>
        <div class="col-7">
            <div class="row mb-5">
                <div class="col">
                    <PuSkeleton height="48px" width="60%"></PuSkeleton>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col d-flex align-items-center justify-content-end">
                    <PuSkeleton height="48px" circle width="48px" class="rounded-pill mr-auto"></PuSkeleton>
                    <PuSkeleton height="48px" width="100px" class="rounded-pill"></PuSkeleton>
                    <PuSkeleton height="48px" width="100px" class="rounded-pill ml-3"></PuSkeleton>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <PuSkeleton v-for="(observer, n) in 5" :key="n" class="mb-3 d-block"></PuSkeleton>
                </div>
            </div>
            <comments></comments>
        </div>
        <div class="col offset-1">
            <div class="row mb-4" v-for="(observer, n) in 5">
                <div class="col">
                    <PuSkeleton width="50%" class="mb-2 d-block"></PuSkeleton>
                    <PuSkeleton height="40px" width="80%" class="mb-2 d-block"></PuSkeleton>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.notification {
    width: 1rem;
    height: 1rem;
    display: inline-block;
    background-image: url(/images/icons/warning.svg);
    background-size: cover;
}
</style>

<script>
import comments from "./comments";
import UserInfo from "../components/user-info";
import ActivityList from "../activities/list";

export default {
    data: function () {
        return {
            statuses: null,
            disabled: {
                status: false,
                favorite: false,
                accept: false,
                transfer: false,
                remove: false
            },
            activities: null,
            issue: null,
            comments: null,
            content: null,
            config: {
                placeholder: 'введите комментарий ..',
            },
            employees: null,
            employee_id: null,
        }
    },
    mounted() {
        let self = this;
        axios.get('/api/v1/issues/' + this.$route.params.id)
            .then(function (response) {
                self.issue = response.data;
                header.loading = false;
                let channel = pusher.subscribe('issue-' + self.issue.id);
                channel.bind('activityCreated', function (data) {
                    self.activities.unshift(data.activity);
                    if (self.activities.length > 5) {
                        self.activities.pop();
                    }
                });
                channel.bind('commentAdded', function (data) {
                    self.comments.push(data.comment);
                });
                channel.bind('issueUpdated', function (data) {
                    self.issue = data.issue;
                });
                setTimeout(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                }, 100);
            });
        axios.get('/api/v1/issues/statuses')
            .then(function (response) {
                header.loading = false;
                self.statuses = response.data;
            });
        axios.get('/api/v1/activity?issue=' + this.$route.params.id).then(function (response) {
            self.activities = response.data.activities;
        });
        axios.get('/api/v1/issues/' + this.$route.params.id + '/comments')
            .then(function (response) {
                self.comments = response.data;
            });
        if (self.$type('service')) {
            axios.get('/api/v1/users?type=employee')
                .then(function (response) {
                    header.loading = false;
                    self.employees = response.data;
                });
        }
    },
    beforeDestroy() {
        let self = this;
        if (self.issue) {
            pusher.unsubscribe('issue-' + self.issue.id);
        }
    },
    methods: {
        checkEmployee(issue) {
            return (this.$user.id === issue.employee.id);
        },
        changeStatus(status) {
            let self = this;
            self.disabled.status = true;
            header.loading = true;
            axios.put('/api/v1/issues/' + this.$route.params.id, {
                issue_status_id: status.id
            })
                .then(function (response) {
                    toastr[response.data.status](response.data.message);
                    self.disabled.status = false;
                    header.loading = false;
                    if (response.data.updated) {
                        self.issue = response.data.issue;
                    }
                }).catch(function () {
                toastr[response.data.status](response.data.message);
            });
        },
        transferIssue(e) {
            let self = this;
            header.loading = true;
            self.disabled.transfer = true;
            axios.put('/api/v1/issues/' + this.$route.params.id, {
                employee_id: self.employee_id
            })
                .then(function (response) {
                    toastr[response.data.status](response.data.message);
                    self.disabled.transfer = false;
                    header.loading = false;
                    if (response.data.updated) {
                        self.issue = response.data.issue;
                        $(e.target).modal('toggle');
                    }
                }).catch(function () {
                toastr[response.data.status](response.data.message);
            });
        },
        acceptIssue() {
            let self = this;
            self.disabled.accept = true;
            header.loading = true;
            axios.put('/api/v1/issues/' + this.$route.params.id, {
                employee_id: this.$user.id,
            })
                .then(function (response) {
                    toastr[response.data.status](response.data.message);
                    self.disabled.accept = false;
                    header.loading = false;
                    if (response.data.updated) {
                        self.issue = response.data.issue;
                    }
                }).catch(function () {
                toastr[response.data.status](response.data.message);
            });
        },
        removeIssue(e) {
            let self = this;
            self.disabled.remove = true;
            header.loading = true;
            axios.delete('/api/v1/issues/' + this.$route.params.id)
                .then(function (response) {
                    toastr[response.data.status](response.data.message);
                    header.loading = false;
                    if (response.data.deleted) {
                        self.issue = response.data.issue;
                        self.issue.isTrashed = true;
                        $(e.target).modal('toggle');
                    }
                }).catch(function () {
                toastr[response.data.status](response.data.message);
            });
        },
        toggleFavorite(issueId, remove) {
            let self = this;
            self.disabled.favorite = true;
            header.loading = true;
            let method = (remove) ? 'delete' : 'post',
                url = '';
            if (remove) {
                url = '/api/v1/issues/favorite/' + this.$route.params.id;
            } else {
                url = '/api/v1/issues/favorite';
            }
            axios[method](url, {
                favorite: self.$route.params.id,
            })
                .then(function (response) {
                    header.loading = false;
                    self.disabled.favorite = false;
                    toastr[response.data.status](response.data.message);
                    if (response.data.toggled) {
                        self.issue = response.data.issue;
                    }
                })
                .catch(function () {
                    header.loading = false;
                    self.disable = false;
                    toastr['error']('Произошла ошибка');
                });
        }
    },
    components: {
        UserInfo,
        comments,
        ActivityList
    }
}
</script>
