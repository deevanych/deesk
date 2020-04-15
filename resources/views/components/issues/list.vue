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
                <li class="mx-3">
                    <a href="#">Новая <span class="badge count">13</span></a>
                </li>
                <li class="mx-3">
                    <a href="#">Решена <span class="badge count">45</span></a>
                </li>
                <li class="mx-3">
                    <a href="#">В работе <span class="badge count">2</span></a>
                </li>
                <li class="mx-3">
                    <a href="#">Закрыта <span class="badge count">13</span></a>
                </li>
            </nav>
            <div class="inline-block ml-auto header-links">
                <router-link :to="{name: 'def'}" class="button p-3 px-4 rounded-pill shadow-sm tonight">Создать заявку
                </router-link>
            </div>
        </div>
        <div class="col-12 block-content">
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Ответственный</th>
                    <th>Дата создания</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
                <tr class="shadow-sm" v-for="issue in organizations">
                    <td>17</td>
                    <td>Болит жопа</td>
                    <td>Тимати</td>
                    <td>Егор Крид</td>
                    <td>12 окт. 2003 г.</td>
                    <td>
                        <div class="status closed">
                            Закрыта
                        </div>
                    </td>
                    <td>ываы</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                organizations: []
            }
        },
        mounted() {
            let app = this;
            axios.get('/api/v1/organization')
                .then(function (resp) {
                    app.organizations = resp.data;
                })
                .catch(function (resp) {
                    alert("Could not load companirees");
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
