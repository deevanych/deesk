<template>
    <div class="row mb-4" v-if="organization">
        <div class="col">
            <vue-headful
                v-bind:title="organization.title"
            />
            <div class="row mb-2">
                <div class="col d-flex mb-4">
                    <h1 class="font-weight-bolder d-flex align-items-center">
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
                            {{ organization.title }}
                        </a>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <img v-bind:src="'/images/logo/'+organization.image" class="mw-80 mb-5 rounded" alt="">
                    <div class="row mb-4">
                        <div class="col">
                            <h6 class="text-gray">Полное наименование</h6>
                            <h5>{{ organization.full_name }}</h5>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <h6 class="text-gray">Сайт</h6>
                            <h5>
                                <a v-bind:href="organization.profile.site" target="_blank">
                                    {{ organization.profile.site }}
                                </a>
                            </h5>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <h6 class="text-gray">Телефон</h6>
                            <h5>
                                <a v-bind:href="'tel:'+organization.profile.phone" target="_blank">
                                    {{ organization.profile.phone }}
                                </a>
                            </h5>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <h6 class="text-gray">Адрес</h6>
                            <h5>
                                <a v-bind:href="'https://www.google.com/maps/place/'+organization.profile.address"
                                   target="_blank">
                                    {{ organization.profile.address }}
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col">
                            <issue-list/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import IssueList from '../issues/list.vue';

    export default {
        components: {
            issueList: IssueList,
        },
        data: function () {
            return {
                organization: null,
                router: this.$router,
            }
        },
        mounted() {
            let self = this;
            axios.get('/api/v1/organizations/' + this.$route.params.id)
                .then(function (response) {
                    self.organization = response.data;
                    header.loading = false;
                });
        },
        methods: {},
    }
</script>
