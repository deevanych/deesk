<template>
    <div class="row mb-5">
        <div class="col-12 block-header">
            <div class="row align-items-center">
                <h3 class="font-weight-bold col flex-grow-0 mb-0 mr-2">Заявки</h3>
                <perfect v-bind:settings="{suppressScrollY: true}"
                         class="col filter position-relative overflow-hidden" v-if="issueStatuses">
                    <nav class="d-flex">
                        <li class="mx-3 d-inline-flex align-items-baseline" v-if="$type('service')">
                            <a href="#" @click.prevent="changeData" data-param="employee" data-value="my">Мои</a>
                        </li>
                        <li class="mx-3 d-inline-flex align-items-baseline">
                            <a href="#" @click.prevent="changeData" class="active">Все</a>
                            <span class="badge count ml-2" v-if="issuesCount">{{ issuesCount }}</span>
                        </li>
                        <li class="mx-3 d-inline-flex flex-shrink-0 align-items-baseline"
                            v-for="status in issueStatuses">
                            <a href="#" @click.prevent="changeData" data-param="status" :data-value="status.id">{{
                                status.title
                                }}</a>
                            <span class="badge count ml-2" v-if="status.issuesCount">{{ status.issuesCount }}</span>
                        </li>
                    </nav>
                </perfect>
                <nav class="d-flex filter ml-4 col" v-else>
                    <li class="mx-3 d-flex align-items-center" v-for="n in 4">
                        <PuSkeleton width="4rem" height="1rem"></PuSkeleton>
                        <PuSkeleton width="1.2rem" height="1.2rem" class="ml-1"></PuSkeleton>
                    </li>
                </nav>
                <div class="col-3 flex-grow-0 header-links d-flex justify-content-end">
                    <router-link :to="{name: 'issues.create'}"
                                 class="button flex-shrink-0 p-3 px-4 rounded-pill shadow-sm tonight">
                        Создать заявку
                    </router-link>
                </div>
            </div>
        </div>
        <div class="col block-content">
            <div class="row">
                <div class="col-3 d-flex align-items-center">
                    <span class="flex-shrink-0 mr-3">Показывать по:</span>
                    <select2
                        v-model="pageCount"
                        v-bind="{values: pageMenu, name: 'page_count', nullable: false, nullTitle: 'Любой'}"
                        v-on:input="changePageLength"></select2>
                </div>
                <div class="col-4 ml-auto text-right">
                    <input type="text" v-model="q" placeholder="поиск .." @keyup="search(q)"
                           class="p-2 px-4 rounded-pill shadow-sm button" name="search[value]">
                </div>
            </div>
            <table class="table dataTable">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Ответственный</th>
                    <th>Дата создания</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <template v-if="!issues">
                    <tr v-for="n in 4">
                        <td v-for="n in 6">
                            <PuSkeleton width="100%" height="1rem"></PuSkeleton>
                        </td>
                    </tr>
                </template>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['url'],
        data: function () {
            return {
                issueStatuses: null,
                issuesCount: null,
                pageCount: null,
                pageMenu: [
                    {'id': 10, 'title': 10},
                    {'id': 20, 'title': 20},
                    {'id': 50, 'title': 50},
                    {'id': 100, 'title': 100},
                ],
                q: null,
                table: null,
                searchTimer: null,
                issues: null,
            }
        },
        mounted() {
            let self = this,
                url = (this.$route.params.id ? '/api/v1/issues/statuses?organization=' + this.$route.params.id : '/api/v1/issues/statuses');
            self.pageCount = 10;
            axios.get(url)
                .then(function (response) {
                    self.issueStatuses = response.data;
                });
            self.table = $('.table').DataTable({
                searching: false,
                bLengthChange: false,
                processing: false,
                language: {
                    processing: "Загрузка ..",
                    search: "поиск ..",
                    lengthMenu: "Показывать по _MENU_ элементов",
                    info: "Показано с _START_ по _END_ элементов. Всего _TOTAL_ элементов.",
                    infoEmpty: "Не найдено совпадений.",
                    infoFiltered: "(вне фильтра _MAX_ элементов)",
                    infoPostFix: "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords: "Элементов нет",
                    emptyTable: "Элементов нет",
                    paginate: {
                        first: "Первая",
                        previous: "Предыдущая",
                        next: "Следующая",
                        last: "Последняя"
                    },
                    aria: {
                        sortAscending: ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                },
                "serverSide": true,
                "lengthMenu": [10, 20, 50, 100],
                "ajax": {
                    "url": self.url,
                    "data": function (d) {
                        d.search['value'] = self.q;
                    },
                    "beforeSend": function (request) {
                        request.setRequestHeader("Authorization", localStorage.getItem('_token'));
                    },
                },
                "columns": [
                    {
                        "data": "id",
                        'render': function (data) {
                            return '<span class="d-block text-center">' + data + '</span>';
                        }
                    },
                    {
                        "data": "title",
                        'render': function (data, type, issue) {
                            return '<a href="' + self.$router.resolve({
                                name: 'issues.show',
                                params: {id: issue.id}
                            }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                                name: 'issues.show',
                                params: {id: issue.id}
                            }).href + '\'); return false;">' + data + '</a>';
                        },
                    },
                    {
                        "data": "author.title",
                        'render': function (data, type, issue) {
                            return '<a href="' + self.$router.resolve({
                                name: 'users',
                                params: {id: issue.author.id}
                            }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                                name: 'users',
                                params: {id: issue.author.id}
                            }).href + '\'); return false;">' + issue.author.title + '</a> / <a href="' + self.$router.resolve({
                                name: 'organizations.show',
                                params: {id: issue.author.organization.id}
                            }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                                name: 'organizations.show',
                                params: {id: issue.author.organization.id}
                            }).href + '\'); return false;">' + issue.author.organization.title + '</a>';
                        },
                        'orderable': false,
                    },
                    {
                        "data": "employee",
                        'render': function (data, type, issue) {
                            if (!data) {
                                return 'Не назначен';
                            }
                            return '<a href="' + self.$router.resolve({
                                name: 'users',
                                params: {id: issue.employee.id}
                            }).href + '" onclick="Vue.prototype.$globalRouter.push(\'' + self.$router.resolve({
                                name: 'organizations.show',
                                params: {id: issue.employee.id}
                            }).href + '\'); return false;">' + issue.employee.title + '</a>';
                        },
                        'orderable': false,
                    },
                    {
                        "data": "created_at",
                        'render': function (data, type, issue) {
                            return Vue.options.methods.getFormattedTime(data);
                        },
                    },
                    {
                        "data": "status.title",
                        'render': function (data, type, issue) {
                            return '<div class="status ' + issue.status.icon.title + ' ' + issue.status.color.title + '">' + data + '</div>';
                        },
                        'orderable': false,
                    },
                ]
            }).on('draw', function () {
                header.loading = false;
                $('.dataTable tbody').show();
                self.issues = {};

            }).on('preXhr', function () {
                header.loading = true;
                $('.dataTable tbody').hide();
                self.issues = null;
            }).on('xhr', function (e, settings, data) {
                self.issuesCount = data.recordsTotal;
            });
        },
        methods: {
            search(q) {
                let self = this;
                clearTimeout(self.searchTimer);
                self.searchTimer = setTimeout(function () {
                    self.table.search(q).draw();
                }, 1000);
            },
            changePageLength() {
                let self = this;
                self.table.page.len(self.pageCount).draw();
            },
            changeData(event) {
                let self = this,
                    url = new URL(window.location.origin + self.url);
                $('.filter a').removeClass('active');
                $(event.target).addClass('active');
                if (event.target.dataset.param && event.target.dataset.value) {
                    url.searchParams.append(event.target.dataset.param, event.target.dataset.value);
                }
                self.table.ajax.url(url);
                self.table.ajax.reload();
            },
        }
    }
</script>

<style>
    .dataTables_wrapper .row:nth-of-type(3) {
        align-items: center;
    }

    ul.pagination {
        margin-bottom: 0;
    }

    .dataTables_wrapper .row:nth-of-type(3) .col-sm-12.col-md-7 {
        display: flex;
    }

    .dataTables_wrapper .row:nth-of-type(3) .col-sm-12.col-md-7 .dataTables_paginate {
        margin-left: auto;
    }

    .dataTables_wrapper .pagination li {
        margin: 0 .2rem;
    }

    .dataTables_wrapper .pagination li a {
        border-radius: 50% !important;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        display: inline-block;
        width: 32px;
        height: 32px;
        line-height: 28px;
        padding: 0;
        text-align: center;
        border: 2px solid #fff;
        box-sizing: border-box;
        transition: .3s;
    }

    .dataTables_wrapper .pagination li a:hover {
        box-shadow: 0.12rem 0.25rem 0.25rem rgba(0, 0, 0, 0.4) !important;
        border-color: #007bff;
        background: #fff;
        color: #007bff;
    }

    .dataTables_wrapper .pagination li.disabled a {
        opacity: .6;
    }

    .dataTables_wrapper .pagination li.previous a, .dataTables_wrapper .pagination li.next a {
        background-image: url('/images/icons/dropdown-left.svg');
        background-repeat: no-repeat;
        background-position: center;
        text-indent: 999999px;
        overflow: hidden;
        background-size: 8px;
    }

    .dataTables_wrapper .pagination li.next a {
        background-image: url('/images/icons/dropdown-right.svg');
    }
</style>
