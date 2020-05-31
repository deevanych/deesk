<template>
    <div>
        <template v-if="users.length > 3">
            <div class="user-short d-flex flex-row align-items-center float-left observer"
                 v-for="(user, n) in users" :key="n" v-if="n <= 2">
                <div class="user-avatar"
                     style=""></div>
            </div>
            <span class="ml-2">
                                    и еще {{ users.length - 3 }}
                                </span>
        </template>
        <template v-else-if="users.length <= 3">
            <div class="user-short d-flex flex-row align-items-center float-left observer"
                 v-for="user in users">
                <div class="user-avatar"
                     style=""></div>
            </div>
        </template>
        <template v-else>
            <div class="user-short d-flex flex-row align-items-center">
                <div class="user-avatar mr-3"
                     style=""></div>
                <div class="d-flex flex-column justify-content-center">
                    <router-link class="font-weight-bolder" :to="{ name: 'users', params: { id: users.id } }">
                        {{ users.title }}
                    </router-link>
                    <router-link
                                 :to="{ name: 'organizations.show', params: { id: users.organization.id } }">
                        {{ users.organization.title }}
                    </router-link>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        props: ['users'],
    }
</script>
