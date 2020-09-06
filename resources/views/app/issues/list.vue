<template>
    <div class="row mb-5">
        <div class="col-12 block-header">
            <div class="row align-items-center">
                <h3 class="font-weight-bold col flex-grow-0 mb-0 mr-2">Заявки</h3>
                <perfect v-bind:settings="{suppressScrollY: true}"
                         class="col filter position-relative overflow-hidden" v-if="issueStatuses">
                    <nav class="d-flex" ref="nav">
                        <li class="mx-3 d-inline-flex align-items-baseline" v-if="$type('service')">
                            <a href="#" @click.prevent="changeData" data-param="employee" data-value="my">Мои</a>
                        </li>
                        <li class="mx-3 d-inline-flex align-items-baseline">
                            <a href="#" @click.prevent="changeData" data-param="type" data-value="observed">Наблюдаю</a>
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
            <data-table :url="ajaxUrl"
                        :columns="columns"></data-table>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            issueStatuses: null,
            issuesCount: null,
            q: null,
            searchTimer: null,
            issues: null,
            url: '/api/v1/issues',
            ajaxUrl: '/api/v1/issues',
            columns: [
                {
                    "data": "id",
                    'title': '#',
                    'render': function (data) {
                        return '<span class="d-block text-center">' + data + '</span>';
                    }
                },
                {
                    'title': 'Название',
                    "data": "title",
                    'render': function (data, type, issue) {
                        return '<a href="' + router.resolve({
                            name: 'issues.show',
                            params: {id: issue.id}
                        }).href + '" onclick="router.push(\'' + router.resolve({
                            name: 'issues.show',
                            params: {id: issue.id}
                        }).href + '\'); return false;">' + data + '</a>';
                    },
                },
                {
                    'title': 'Автор',
                    "data": "author.title",
                    'render': function (data, type, issue) {
                        return '<a href="' + router.resolve({
                            name: 'users.show',
                            params: {id: issue.author.id}
                        }).href + '" onclick="router.push(\'' + router.resolve({
                            name: 'users.show',
                            params: {id: issue.author.id}
                        }).href + '\'); return false;">' + issue.author.title + '</a> / <a href="' + router.resolve({
                            name: 'organizations.show',
                            params: {id: issue.author.organization.id}
                        }).href + '" onclick="router.push(\'' + router.resolve({
                            name: 'organizations.show',
                            params: {id: issue.author.organization.id}
                        }).href + '\'); return false;">' + issue.author.organization.title + '</a>';
                    },
                    'orderable': false,
                },
                {
                    'title': 'Ответственный',
                    "data": "employee",
                    'render': function (data, type, issue) {
                        if (!data) {
                            return 'Не назначен';
                        }
                        return '<a href="' + router.resolve({
                            name: 'users.show',
                            params: {id: issue.employee.id}
                        }).href + '" onclick="router.push(\'' + router.resolve({
                            name: 'users.show',
                            params: {id: issue.employee.id}
                        }).href + '\'); return false;">' + issue.employee.title + '</a>';
                    },
                    'orderable': false,
                },
                {
                    'title': 'Дата создания',
                    "data": "created_at",
                    'render': function (data, type, issue) {
                        return Vue.options.methods.getFormattedTime(data);
                    },
                },
                {
                    'title': 'Статус',
                    "data": "status.title",
                    'render': function (data, type, issue) {
                        return '<div class="status ' + issue.status.icon.title + ' ' + issue.status.color.title + '">' + data + '</div>';
                    },
                    'orderable': false,
                },
            ]
        }
    },
    mounted() {
        let self = this,
            url = (this.$route.params.id ? '/api/v1/issues/statuses?' + self.type + '=' + this.$route.params.id : '/api/v1/issues/statuses');
        axios.get(url)
            .then(function (response) {
                self.issueStatuses = response.data;
            });
    },
    methods: {
        changeData(event) {
            let self = this,
                url = new URL(window.location.origin + self.url);
            $(self.$refs.nav).find('a').removeClass('active');
            $(event.target).addClass('active');
            if (event.target.dataset.param && event.target.dataset.value) {
                url.searchParams.append(event.target.dataset.param, event.target.dataset.value);
            }
            self.ajaxUrl = url.href;
        },
    }
}
</script>
