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
                                 class="svg-inline--fa fa-long-arrow-alt-left fa-w-14 fa-3x mr-4"
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
                    <template v-if="!issue.employee">
                        <a href="/"
                           class="button p-3 px-4 rounded-pill shadow-sm white router-link-exact-active router-link-active"
                           v-on:click.prevent="acceptIssue">
                            Принять
                        </a>
                    </template>
                    <template v-else>
                        <a href="/"
                           class="button p-3 px-4 rounded-pill shadow-sm white router-link-exact-active router-link-active"
                           v-if="issue.my"
                           v-on:click.prevent="acceptIssue">
                            Передать
                        </a>
                    </template>
                    <button
                        class="ml-3 button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active dropdown-toggle"
                        v-bind:class="issue.status.color.title" data-toggle="dropdown" data-color="white"
                        aria-haspopup="true"
                        aria-expanded="false"
                        :disabled="disabled.status">
                            <span class="status white"
                                  v-bind:class="issue.status.icon.title">
                                {{ issue.status.title }}
                            </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
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
                    <span>{{ issue.description }}</span>
                </div>
            </div>
            <comments></comments>
        </div>
        <div class="col offset-1">
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Дата создания</h6>
                    <h5>{{ issue.created_at }}</h5>
                </div>
            </div>
            <div class="row mb-4" v-if="issue.updated_at">
                <div class="col">
                    <h6 class="text-gray">Дата обновления</h6>
                    <h5>{{ issue.updated_at }}</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Автор</h6>
                    <div class="user-short d-flex flex-row align-items-center">
                        <div class="user-avatar mr-3"
                             style="background-image: url(https://deesk.ru/storage/clients/2.jpg);"></div>
                        <div class="d-flex flex-column justify-content-center">
                            <a class="font-weight-bolder">{{ issue.author.title }}</a>
                            <a class="text-gray">{{ issue.author.organization.title }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Ответственный</h6>
                    <div v-if="issue.employee" class="user-short d-flex flex-row align-items-center">
                        <div class="user-avatar mr-3"
                             style="background-image: url(https://deesk.ru/storage/clients/2.jpg);"></div>
                        <div class="d-flex flex-column justify-content-center">
                            <a class="font-weight-bolder">{{ issue.employee.title }}</a>
                            <a class="text-gray">{{ issue.employee.organization.title }}</a>
                        </div>
                    </div>
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
                        <template v-if="issue.observers.length > 0">
                            <template v-if="issue.observers.length > 3">
                                <div class="user-short d-flex flex-row align-items-center float-left observer"
                                     v-for="(observer, n) in issue.observers" :key="n" v-if="n <= 2">
                                    <div class="user-avatar"
                                         style="background-image: url(&quot;https://deesk.ru/storage/clients/2.jpg&quot;);"></div>
                                </div>
                                <span class="ml-2">
                                    и еще {{ issue.observers.length - 3 }}
                                </span>
                            </template>
                            <template v-else-if="issue.observers.length == 1">
                                <div class="user-short d-flex flex-row align-items-center"
                                     v-for="observer in issue.observers">
                                    <div class="user-avatar mr-3"
                                         style="background-image: url(&quot;https://deesk.ru/storage/clients/2.jpg&quot;);"></div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <a class="font-weight-bolder">{{ observer.title }}</a>
                                        <a class="text-gray">{{ observer.organization.title }}</a></div>
                                </div>
                            </template>
                            <template v-else-if="issue.observers.length <= 3">
                                <div class="user-short d-flex flex-row align-items-center float-left observer"
                                     v-for="observer in issue.observers">
                                    <div class="user-avatar"
                                         style="background-image: url(&quot;https://deesk.ru/storage/clients/2.jpg&quot;);"></div>
                                </div>
                            </template>
                        </template>
                        <template v-else>
                            <h5>Наблюдателей нет</h5>
                        </template>
                    </div>
                    <h5 v-else>Наблюдателей нет</h5>
                </div>
            </div>
        </div>
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

<script>
    import comments from "./comments";

    export default {
        data: function () {
            return {
                issue: null,
                router: this.$router,
                statuses: null,
                disabled: {
                    status: false,
                    favorite: false,
                    accept: false,
                },
                comments: null,
                content: null,
                config: {
                    placeholder: 'введите комментарий ..',
                },
            }
        },
        mounted() {
            let self = this;
            axios.get('/api/v1/issues/' + this.$route.params.id)
                .then(function (response) {
                    self.issue = response.data;
                    header.loading = false;
                });
            axios.get('/api/v1/issues/statuses')
                .then(function (response) {
                    self.statuses = response.data;
                });
        },
        methods: {
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
            acceptIssue() {
                let self = this;
                self.disabled.accept = true;
                header.loading = true;
                axios.put('/api/v1/issues/' + this.$route.params.id, {
                    employee_id: userId,
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
            comments: comments,
        }
    }
</script>
