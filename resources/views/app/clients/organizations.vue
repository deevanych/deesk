<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <h3 class="font-weight-bold d-inline-block mb-0">Организации</h3>
                    <a href="/"
                       class="button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active"
                       data-toggle="modal" data-target="#addIssueStatus">
                        Добавить организацию
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <table class="table">
                        <template v-if="clients">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Название</th>
                            </tr>
                            <template v-if="clients.length">
                                <tr v-for="(client, key) in clients" class="shadow-sm" :key="client.id">
                                    <td class="text-center">{{ client.id}}</td>
                                    <td>
                                        <router-link :to="{name: 'organizations.show', params: { id: client.id } }">
                                            {{client.title}}
                                        </router-link>
                                    </td>
                                </tr>
                            </template>
                            <tr v-else>
                                <td colspan="2">
                                    К сожалению, клиентов нет 😪
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Название</th>
                            </tr>
                            <tr v-for="n in 4">
                                <td v-for="n in 2">
                                    <PuSkeleton width="100%" height="1rem"></PuSkeleton>
                                </td>
                            </tr>
                        </template>
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
                clients: null,
            }
        },
        mounted() {
            let self = this;
            axios.get('/api/v1/organizations')
                .then(function (response) {
                    header.loading = false;
                    self.clients = response.data;
                });
        }
    }
</script>
