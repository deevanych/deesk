<template>
    <div>
        <vue-headful
            title="Клиенты"
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
                        Клиенты
                    </a>
                </h1>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4">
                <div class="row mb-4 px-5 pt-5 pb-0 menu">
                    <div class="col">
                        <div class="row mb-5">
                            <div class="col">
                                <h5>Клиенты</h5>
                                <router-link :to="{name: 'clients.organizations'}" class="d-block mt-1">Организации</router-link>
                                <router-link :to="{name: 'clients.contacts'}" class="d-block mt-1">Контакты</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 pl-5">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .menu {
        background: #e5edfa;
        border-radius: 50px;
    }
</style>

<script>
    export default {
        data: function () {
            return {
                router: this.$router,
            }
        },
        mounted() {
            let self = this;
            header.loading = true;
        },
        methods: {},
        components: {}
    }
</script>
