<template>
    <div class="row mb-5">
        <div class="col block-header d-flex align-items-center">
            <h3 class="font-weight-bold d-inline-block mb-0">Заявки</h3>
            <nav class="d-flex filter ml-4">
                <li class="mx-3">
                    <a href="#" class="active">Мои</a>
                </li>
                <li class="mx-3">
                    <a href="#">Все</a>
                </li>
                <li class="mx-3" v-for="status in issueStatuses">
                    <a href="#">{{ status.title }}<span class="badge count ml-2">13</span></a>
                </li>
            </nav>
            <div class="inline-block ml-auto header-links">
                <router-link :to="{name: 'home'}" class="button p-3 px-4 rounded-pill shadow-sm tonight">Создать заявку
                </router-link>
            </div>
        </div>
        <div class="col-12 block-content">
            <table class="table">
                <tr>
                    <th class="text-center">#</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Ответственный</th>
                    <th>Дата создания</th>
                    <th>Статус</th>
                </tr>
                <tr v-if="!issues">
                    <td colspan="7" class="text-center">К сожалению, заявок нет 😪</td>
                </tr>
                <tr class="shadow-sm" v-else v-for="issue in issues">
                    <td class="text-center">{{ issue.id }}</td>
                    <td>
                        <router-link :to="{ name: 'issues', params: { id: issue.id } }">
                            {{ issue.title }}
                        </router-link>
                        <br/>
                    </td>
                    <td>
                        <router-link :to="{ name: 'users', params: { id: issue.author.id } }">
                            {{ issue.author.name }}
                        </router-link>
                        (
                        <router-link :to="{ name: 'organizations', params: { id: issue.author.organization.id } }">
                            {{ issue.author.organization.short_name }}
                        </router-link>
                        )
                    </td>
                    <td v-if="issue.employee">
                        <router-link :to="{ name: 'users', params: { id: issue.employee.id } }">
                            {{ issue.employee.name }}
                        </router-link>
                    </td>
                    <td v-else>Не назначен</td>
                    <td>{{ issue.created_at }}</td>
                    <td>
                        <div class="status" v-bind:class="[issue.status.icon.title, issue.status.color.title]">
                            {{ issue.status.title }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                issues: null,
                issueStatuses: null,
            }
        },
        mounted() {
            let app = this;
            axios.get('/api/v1/issues')
                .then(function (resp) {
                    app.issues = resp.data;
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
        }
    }
</script>
