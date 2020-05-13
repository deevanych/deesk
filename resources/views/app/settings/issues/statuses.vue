<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <h3 class="font-weight-bold d-inline-block mb-0">Статусы</h3>
                    <a href="/"
                       class="button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active">
                        Добавить тип
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <table class="table">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Управление</th>
                        </tr>
                        <tr class="shadow-sm" v-for="type in types">
                            <td class="text-center">{{ type.id }}</td>
                            <td>{{ type.title }}</td>
                            <td>{{ type.description }}</td>
                            <td>324</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                router: this.$router,
                types: [],
            }
        },
        mounted() {
            let self = this;
            header.loading = false;
            axios.get('/api/v1/issues/types')
                .then(function (response) {
                    self.types = response.data;
                });
        },
        methods: {},
        components: {}
    }
</script>
