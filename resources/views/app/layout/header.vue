<template>
    <div>
        <div id="loading-bar" v-bind:class="{loading: loading}"></div>
        <header class="py-5 mb-5">
            <div class="row">
                <div class="col">
                    <router-link :to="{name: 'home'}" class="logo">
                        <span class="d-block position-absolute w-100 h-100"></span>
                        <img src="/images/logo/logo-small.png"/>
                    </router-link>
                </div>
                <nav class="col-9 d-flex align-items-center justify-content-end">
                    <form class="mr-4 mb-0" id="search">
                        <input type="text" class="p-2 px-3 rounded-pill shadow-sm" placeholder="поиск .."/>
                    </form>
                    <template v-if="this.$user">
                        <li class="mx-4" v-if="$can('issue.view')">
                            <a href="#">Заявки</a>
                        </li>
                        <li class="mx-4" v-if="$can('client.view')">
                            <router-link :to="{name: 'clients'}">
                                Клиенты
                            </router-link>
                        </li>
                        <li class="mx-4" v-if="$can('settings.view')">
                            <router-link :to="{name: 'settings'}">
                                Настройки
                            </router-link>
                        </li>
                        <li class="ml-4">
                            <router-link :to="{name: 'logout'}" class="button white p-3 px-4 rounded-pill shadow-sm">
                                {{ this.$user.title }}
                            </router-link>
                        </li>
                    </template>
                    <template v-else>
                        <PuSkeleton v-for="(observer, n) in 3" :key="n"  height="18px" width="60px" class="mx-4"></PuSkeleton>
                    </template>
                </nav>
            </div>
        </header>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                loading: false,
            }
        },
        mounted() {
            window.header = this;
            this.loading = false;
        }
    }
</script>
