<template>
    <div class="row mb-4" v-if="user">
        <div class="col">
            <vue-headful
                v-bind:title="user.title"
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
                            {{ user.title }}
                        </a>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="row ml-1 mb-5 mw-80 rounded profile-avatar overflow-hidden position-relative">
                        <img v-if="user.profile && user.profile.avatar" v-bind:src="user.profile.avatar"
                             class="w-100" alt="">
                        <img v-else src="/images/site/avatar_default.gif" class="w-100" alt="">
                        <label for="avatar-upload" class="position-absolute w-100 h-100 avatar-upload"
                               ref="avatarUpload">
                            Загрузить фото
                        </label>
                        <form class="d-none">
                            <input id="avatar-upload" @change="uploadAvatar" type="file" name="files[]"/>
                        </form>
                    </div>
                    <div class="row mb-4" v-if="user.profile && user.profile.status">
                        <div class="col">
                            <h6 class="user-status">{{ user.profile.status }}</h6>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <h6 class="text-gray">Организация</h6>
                            <h5>
                                <router-link
                                    :to="{ name: 'organizations.show', params: { id: user.organization.id } }">
                                    {{ user.organization.title }}
                                </router-link>
                            </h5>
                        </div>
                    </div>
                    <div class="row mb-4" v-if="user.profile && user.profile.position">
                        <div class="col">
                            <h6 class="text-gray">Должность</h6>
                            <h5>
                                {{ user.profile.position }}
                            </h5>
                        </div>
                    </div>
                    <template v-if="user.profile">
                        <div class="row mb-4" v-if="user.profile.fio">
                            <div class="col">
                                <h6 class="text-gray">ФИО</h6>
                                <h5>{{ user.profile.fio }}</h5>
                            </div>
                        </div>
                        <div class="row mb-4" v-if="user.profile.phone">
                            <div class="col">
                                <h6 class="text-gray">Телефон</h6>
                                <h5>
                                    <a target="_blank" class="icon phone" v-bind:href="'tel://'+user.profile.phone">{{
                                        user.profile.phone
                                        }}</a>
                                </h5>
                            </div>
                        </div>
                        <div class="row mb-4" v-if="user.profile.email">
                            <div class="col">
                                <h6 class="text-gray">Email</h6>
                                <h5>
                                    <a target="_blank" class="icon email" v-bind:href="'mailto://'+user.profile.email">{{
                                        user.profile.email
                                        }}</a>
                                </h5>
                            </div>
                        </div>
                        <div class="row mb-4" v-if="user.profile.facebook">
                            <div class="col">
                                <h6 class="text-gray">Facebook</h6>
                                <h5>
                                    <a target="_blank" class="icon facebook"
                                       v-bind:href="'https://facebook.com/'+user.profile.facebook">{{
                                        user.profile.facebook
                                        }}</a>
                                </h5>
                            </div>
                        </div>
                        <div class="row mb-4" v-if="user.profile.vk">
                            <div class="col">
                                <h6 class="text-gray">VK</h6>
                                <h5>
                                    <a target="_blank" class="icon vk" v-bind:href="'https://vk.com/'+user.profile.vk">{{
                                        user.profile.vk
                                        }}</a>
                                </h5>
                            </div>
                        </div>
                        <div class="row mb-4" v-if="user.profile.instagram">
                            <div class="col">
                                <h6 class="text-gray">Instagram</h6>
                                <h5>
                                    <a target="_blank" class="icon instagram"
                                       v-bind:href="'https://instagram.com/'+user.profile.instagram">{{
                                        user.profile.instagram
                                        }}</a>
                                </h5>
                            </div>
                        </div>
                        <div class="row mb-4" v-if="user.profile.telegram">
                            <div class="col">
                                <h6 class="text-gray">Telegram</h6>
                                <h5>
                                    <a target="_blank" class="icon telegram"
                                       v-bind:href="'https://t.me/'+user.profile.telegram">{{
                                        user.profile.telegram
                                        }}</a>
                                </h5>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col">
                            <issue-list v-bind:url="'/api/v1/issues?user=' + this.$route.params.id"
                                        v-bind:type="'user'"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import IssueList from '../issues/list.vue';
    import XHRUpload from "@uppy/xhr-upload";
    import Uppy from "@uppy/core";
    import FileInput from "@uppy/file-input";

    export default {
        components: {
            issueList: IssueList,
        },
        data: function () {
            return {
                user: null,
                router: this.$router,
                issues: null,
            }
        },
        mounted() {
            let self = this;
            axios.get('/api/v1/users/' + this.$route.params.id)
                .then(function (response) {
                    self.user = response.data;
                    header.loading = false;
                });
            self.instantiateUppy();
        },
        methods: {
            instantiateUppy() {
                let self = this;
                this.uppy = Uppy({
                    autoProceed: true,
                    allowMultipleUploads: true,
                    restrictions: {
                        maxFileSize: 3145728,
                        allowedFileTypes: ['image/*']
                    }
                }).use(XHRUpload, {
                    endpoint: '/files/user/' + this.$route.params.id + '/avatar',
                    fieldName: 'avatar',
                    method: 'POST',
                    limit: 0,
                    headers: {
                        'Authorization': localStorage.getItem('_token'),
                    }
                });
                this.uppy.on('complete', (event) => {
                    toastr['success']('Изображение загружено');
                    self.user.profile.avatar = event.successful[0].response.body.url;
                });
            },
            uploadAvatar(event) {
                let files = Array.from(event.target.files);
                files.forEach((file) => {
                    try {
                        this.uppy.addFile({
                            name: file.name,
                            type: file.type,
                            data: file
                        })
                    } catch (err) {
                        if (err.isRestriction) {
                            toastr['error'](err);
                        } else {
                            console.error(err)
                        }
                    }
                });
            }
        },
    }
</script>
