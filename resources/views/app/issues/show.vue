<template>
    <div class="row mb-4">
        <div class="col-7" v-if="issue">
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
                    <a class="button rounded-pill fave add mr-auto p-4 shadow-sm"></a>
                    <a href="/"
                       class="button p-3 px-4 rounded-pill shadow-sm white router-link-exact-active router-link-active">Принять
                    </a>
                    <button
                        class="ml-3 button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active dropdown-toggle"
                        v-bind:class="issue.status.color.title" data-toggle="dropdown" data-color="white"
                        aria-haspopup="true"
                        aria-expanded="false"
                        :disabled="disable">
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
        <div class="col-7" v-else>
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
                    <PuSkeleton v-for="n in 5" class="mb-3 d-block"></PuSkeleton>
                </div>
            </div>
            <comments></comments>
        </div>
        <div class="col offset-1" v-if="issue">
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
                            <a class="font-weight-bolder">{{ issue.author.name }}</a>
                            <a class="text-gray">{{ issue.author.organization.short_name }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Ответственный</h6>
                    <h5>Не назначен</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Тип заявки</h6>
                    <h5>{{ issue.type.title }}</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Приоритет заявки</h6>
                    <h5>{{ issue.priority.title }}</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Наблюдатели</h6>
                    <h5>Наблюдателей нет</h5>
                </div>
            </div>
        </div>
        <div class="col offset-1" v-else>
            <div class="row mb-4" v-for="n in 5">
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
                disable: false,
                comments: null,
                content: null,
                config: {
                    placeholder: 'введите комментарий ..',
                },
            }
        },
        mounted() {
            let app = this;
            axios.get('/api/v1/issues/' + this.$route.params.id)
                .then(function (response) {
                    app.issue = response.data;
                    header.loading = false;
                });
            axios.get('/api/v1/statuses')
                .then(function (response) {
                    app.statuses = response.data;
                });
        },
        methods: {
            changeStatus(status) {
                let app = this;
                app.disable = true;
                header.loading = true;
                axios.put('/api/v1/issues/' + this.$route.params.id, {
                    issue_status_id: status.id
                })
                    .then(function (response) {
                        toastr[response.data.status](response.data.message);
                        app.disable = false;
                        header.loading = false;
                        if (response.data.updated) {
                            app.issue.status = response.data.issue.status;
                            app.issue.updated_at = response.data.issue.updated_at;
                        }
                    }).catch(function () {
                    toastr[response.data.status](response.data.message);
                });
            },
        },
        components: {
            comments: comments,
        }
    }
</script>
