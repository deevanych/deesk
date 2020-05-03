<template>
    <div>
        <div id="loading-bar" v-bind:class="{loading: loading}"></div>
        <header class="py-5 mb-5">
            <div class="row">
                <div class="col">
                    <router-link :to="{name: 'home'}" class="logo">DEESK</router-link>
                </div>
                <nav class="col-10 d-flex align-items-center justify-content-end">
                    <form class="mr-4 mb-0" id="search">
                        <input type="text" class="p-2 px-3 rounded-pill shadow-sm" placeholder="поиск .."/>
                    </form>
                    <li class="mx-4"><a href="#">Заявки</a></li>
                    <li class="mx-4"><a href="#">Контакты</a></li>
                    <li class="mx-4"><a href="#">Настройки</a></li>
                    <li class="ml-4">
                        <router-link :to="{name: 'logout'}" class="button white p-3 px-4 rounded-pill shadow-sm">Личный
                            кабинет
                        </router-link>
                    </li>
                </nav>
            </div>
        </header>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                loading: true,
            }
        },
        mounted() {
            window.header = this;
            this.loading = false;
        }
    }
</script>
