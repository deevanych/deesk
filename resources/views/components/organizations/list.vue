<template>
    <div class="row mb-5">
        <div class="col block-header d-flex align-items-center">
            <h3 class="font-weight-bold d-inline-block mb-0">Клиенты</h3>
            <div class="inline-block ml-auto header-links">
                <a href="#">Все клиенты</a>
                <router-link :to="{name: 'home'}" class="ml-5 button p-3 px-4 rounded-pill shadow-sm tonight">Добавить
                    клиента
                </router-link>
            </div>
        </div>
        <div class="col-12 block-content">
            <div class="row">
                <div class="col" v-if="!clients">
                    К сожалению, клиентов нет 😪
                </div>
                <div class="col-4" v-else v-for="client in clients">
                    <a class="client rounded-lg shadow-sm"
                       v-bind:style="{ backgroundImage: 'url(' + client.image + ')' }"
                       href="#">
                        <span class="client-background"></span>
                        <span class="client-title">{{ client.short_name }}</span>
                        <span
                            class="client-description">{{ $tc('message.issuesCount', client.client_issues_count) }}</span>
                    </a>
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
            let app = this;
            axios.get('/api/v1/organizations')
                .then(function (resp) {
                    app.clients = resp.data;
                });
        },
    }
</script>
