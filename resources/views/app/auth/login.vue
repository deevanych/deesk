<template>
    <div class="h-100 d-flex flex-column align-items-center justify-content-center">
        <vue-headful
            title="Вход в панель"
        />
        <div class="row w-100 mb-3">
            <img src="/images/logo/logo-full.png" alt="" class="col-6 m-auto d-block">
        </div>
        <div class="row w-100 mt-5">
            <form class="col-6 m-auto" v-on:submit.prevent="auth">
                <div class="form-group w-100">
                    <input type="text" placeholder=" " v-model="data.username" required/>
                    <span>email</span>
                    <input type="text" class="helper">
                </div>
                <div class="form-group">
                    <input type="password" placeholder=" " v-model="data.password" required/>
                    <span>пароль</span>
                    <input type="text" class="helper">
                </div>
                <input type="submit" :disabled="disabled" value="Войти"
                       class="button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active"/>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        path: '/login',
        name: 'login',
        data: function () {
            return {
                data: {
                    username: 'service@test.com',
                    password: 123456,
                    grant_type: "password",
                    client_secret: "M7AmP0MDEdnFq9rhyzuSfvvYOWlxAXbELJPqhCPB",
                    client_id: 1,
                    scope: "*",
                },
                disabled: false,
            }
        },
        methods: {
            auth() {
                this.disabled = true;
                let self = this;
                axios.post('/oauth/token', this.data)
                    .then(function (response) {
                        if (!response.data.error) {
                            let token = response.data.token_type + ' ' + response.data.access_token;
                            axios.defaults.headers.common['Authorization'] = token;
                            localStorage.setItem('_token', token);
                            axios.get('/api/v1/users/my').then(function (response) {
                                localStorage.setItem('user_id', response.data.id);
                                localStorage.setItem('userInfo', JSON.stringify(response.data));
                            });
                            self.$router.push({name: 'home'});
                        }
                    });
            }
        }
    }
</script>
