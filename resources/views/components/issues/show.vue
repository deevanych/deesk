<template>
    <div class="row mb-4">
        <div class="col-7" v-if="issue">
            <vue-headful
                v-bind:title="issue.title"
            />
            <div class="row mb-2">
                <div class="col">
                    <h1 class="font-weight-bolder mb-4 d-flex align-items-center">
                        <a href="#" class="back-link" v-on:click="router.go(-1)">
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
                    <a href="#" class="button rounded-pill fave add mr-auto p-4 shadow-sm"></a>
                    <a href="/"
                       class="button p-3 px-4 rounded-pill shadow-sm white router-link-exact-active router-link-active">Принять
                    </a>
                    <a href="/"
                       class="ml-3 button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active dropdown-toggle"
                       v-bind:class="issue.status.color.title" data-toggle="dropdown" data-color="white"
                       aria-haspopup="true"
                       aria-expanded="false">{{ issue.status.title }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item status white" href="#" v-for="status in issueStatuses">
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
            <div class="row mb-4 comments-block shadow-sm p-5">
                <div class="col">
                    <h4 class="text-gray mb-4 font-weight-bold">Комментарии <span class="badge count ml-2">{{ comments.length }}</span>
                    </h4>
                    <div class="comments" v-if="comments.length">
                        <div class="comment d-flex align-items-end" v-for="comment in comments"
                             v-bind:class="{ self: comment.self}">
                            <div class="user-avatar flex-shrink-0"
                                 style="background-image: url(http://deesk.ru/storage/clients/2.jpg);"></div>
                            <div class="comment-body d-flex flex-column px-4 py-3">
                                <span class="comment-author font-weight-bolder">{{ comment.author.name }}</span>
                                <span class="comment-text">{{ comment.text }}</span>
                            </div>
                            <span class="comment-date flex-shrink-0">{{ comment.created_at }}</span>
                        </div>
                    </div>
                    <div class="comments" v-else>
                        Комментариев нет
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <quill v-model="content" :config="config"></quill>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="offset-8 col">
                            <a href="#" class="button p-3 px-4 rounded-pill shadow-sm blue text-center d-block">Отправить</a>
                        </div>
                    </div>
                </div>
            </div>
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
            <div class="row mb-4">
                <div class="col">
                    <PuSkeleton height="500px"></PuSkeleton>
                </div>
            </div>
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
                             style="background-image: url(http://deesk.ru/storage/clients/2.jpg);"></div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href="#" class="text-dark font-weight-bolder">{{ issue.author.name }}</a>
                            <a href="#" class="text-gray">{{ issue.author.organization.short_name }}</a>
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
    export default {
        data: function () {
            return {
                issue: null,
                router: this.$router,
                content: null,
                comments: null,
                statuses: null,
                config: {
                    placeholder: 'введите комментарий ..',
                },
                title: null
            }
        },
        mounted() {
            let app = this;
            axios.get('/api/v1/issues/' + this.$route.params.id)
                .then(function (resp) {
                    app.issue = resp.data;
                    app.comments = resp.data.comments;
                    app.title = resp.data.title;
                });
            axios.get('/api/v1/statuses')
                .then(function (response) {
                    app.issueStatuses = response.data;
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    let app = this;
                    axios.delete('/api/v1/organizations/' + id)
                        .then(function (resp) {
                            app.companies.splice(list, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete company");
                        });
                }
            }
        },
        components: {
            quill: require('vue-quill/src/Quill.vue').default,
        },
    }
</script>

<style scoped>
    .user-avatar {
        border-radius: 50%;
        width: 30px;
        height: 30px;
        background-position: center;
        background-size: cover;
    }

    .comments {
        max-height: 500px;
        overflow: auto;
    }

    .comment {
        position: relative;
        margin-bottom: 3rem;
    }

    .comment .user-avatar {
        margin-right: 1rem;
    }

    .comment-body {
        background: #f8f9fa;
        border-radius: 10px 10px 10px 0px;
    }

    .comment-author {
        color: rgba(0, 0, 0, .5);
    }

    .comment .comment-date {
        margin-left: 0.5rem;
        color: rgba(0, 0, 0, .5);
        font-size: 0.7rem;
        position: absolute;
        bottom: -30px;
        left: 40px;
    }

    .comment.self .comment-body {
        background: #56a9ff;
        border-radius: 10px 10px 0px 10px;
    }

    .comment.self .comment-body .comment-text, .comment.self .comment-body .comment-author {
        color: #fff;
        text-align: right;
    }

    .comment.self {
        flex-direction: row-reverse;
    }

    .comment.self .user-avatar {
        width: 30px;
        height: 30px;
        margin-right: 0rem;
        margin-left: 1rem;
    }

    .comment.self .comment-date {
        left: initial;
        margin-right: 0.5rem;
        right: 40px;
    }

    .comments-block {
        border-radius: 50px;
    }
</style>
