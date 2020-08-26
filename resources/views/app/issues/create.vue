<template>
    <div class="row mb-4">
        <div class="col-7">
            <vue-headful
                v-bind:title="issue.title"
            />
            <div class="row mb-5">
                <div class="col">
                    <h1 class="font-weight-bolder mb-4 d-flex align-items-center">
                        <a class="back-link d-flex align-items-center" v-on:click="router.go(-1)">
                            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="long-arrow-alt-left"
                                 role="img"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                 class="svg-inline--fa fa-long-arrow-alt-left fa-w-14 fa-3x mr-4 flex-shrink-0"
                                 width="30">
                                <path fill="currentColor"
                                      d="M107.515 150.971L8.485 250c-4.686 4.686-4.686 12.284 0 16.971L107.515 366c7.56 7.56 20.485 2.206 20.485-8.485v-71.03h308c6.627 0 12-5.373 12-12v-32c0-6.627-5.373-12-12-12H128v-71.03c0-10.69-12.926-16.044-20.485-8.484z"
                                      class=""></path>
                            </svg>
                            {{ issue.title }}
                        </a>
                    </h1>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="form-group w-100">
                        <input type="text" v-model="issue.title" placeholder=" " required v-on:blur="setDefaultTitle"/>
                        <span>
                            <span>Название</span>
                            <span class="text-warning"
                                  v-if="!$v.issue.title.required">(обязательное поле)</span>
                            <span class="text-warning" v-if="!$v.issue.title.minLength">(минимальная длина - {{$v.issue.title.$params.minLength.min}} знака)</span>
                            <span class="text-warning" v-if="!$v.issue.title.maxLength">(максимальная длина - {{$v.issue.title.$params.maxLength.max}} знаков)</span>
                        </span>
                        <input type="text" class="helper">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group w-100">
                        <summernote v-model="issue.description" v-bind="{placeholder: 'Введите текст заявки ..', name: 'text', required: true}"></summernote>
                        <span>
                            <span>Текст</span>
                            <span class="text-warning"
                                  v-if="!$v.issue.description.required">(обязательное поле)</span>
                            <span class="text-warning" v-if="!$v.issue.description.minLength">(минимальная длина - {{$v.issue.description.$params.minLength.min}} знака)</span>
                            <span class="text-warning" v-if="!$v.issue.description.maxLength">(максимальная длина - {{$v.issue.description.$params.maxLength.max}} знаков)</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="offset-8 col">
                    <button type="submit" :disabled="disable" v-on:click.prevent="createIssue"
                            class="button ml-auto p-3 px-4 rounded-pill shadow-sm blue text-center d-block">Создать заявку
                    </button>
                </div>
            </div>
        </div>
        <div class="col offset-1">
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Дата создания</h6>
                    <h5>{{ issue.created_at }}</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Автор</h6>
                    <select2
                        v-model="issue.author_id"
                        v-bind="{values: employees, name: 'author_id', nullable: false, nullTitle: 'Не назначен', groups: true, placeholder: 'Выберите автора'}"
                    v-if="$type('service')"></select2>
                    <user-info v-else v-bind:users="issue.author"></user-info>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Тип заявки</h6>
                    <select2
                        v-model="issue.issue_type_id"
                        v-bind="{values: issueTypes, name: 'issue_type_id', nullable: true, nullTitle: 'Не назначен'}"></select2>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Приоритет заявки</h6>
                    <select2
                        v-model="issue.issue_priority_id"
                        v-bind="{values: issuePriorities, name: 'issue_priority_id', nullable: true, nullTitle: 'Не назначен'}"></select2>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Наблюдатели</h6>
                    <select2
                        v-model="issue.observer_ids"
                        v-bind="{values: employees, name: 'observer_ids[]', nullable: false, nullTitle: 'Не назначены', multiple: true, groups: true, placeholder: 'Выберите наблюдателей'}"></select2>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserInfo from "../components/user-info";
    import {maxLength, minLength, required} from "vuelidate/lib/validators";

    export default {
        data: function () {
            return {
                issue: {
                    title: 'Новая заявка',
                    description: null,
                    created_at: null,
                    issue_type_id: null,
                    issue_priority_id: null,
                    registration_type_id: 1,
                    author_id: this.$user.id,
                    observer_ids: [],
                    author: this.$user
                },
                issueTypes: null,
                issuePriorities: null,
                employees: null,
                disable: false,
                router: this.$router,
                statuses: null,
                config: {
                    placeholder: 'введите комментарий ..',
                },
            }
        },
        validations: {
            issue: {
                title: {
                    required,
                    minLength: minLength(4),
                    maxLength: maxLength(100)
                },
                description: {
                    required,
                    minLength: minLength(10),
                    maxLength: maxLength(10000000)
                },
            },
        },
        mounted() {
            let self = this;
            header.loading = false;
            axios.get('/api/v1/issues/types')
                .then(function (response) {
                    header.loading = false;
                    self.issueTypes = response.data;
                });
            axios.get('/api/v1/issues/priorities')
                .then(function (response) {
                    header.loading = false;
                    self.issuePriorities = response.data;
                });
            axios.get('/api/v1/users')
                .then(function (response) {
                    header.loading = false;
                    self.employees = response.data;
                });
            self.setCreatedTime();
            setInterval(function () {
                self.setCreatedTime();
            }, 10000);
        },
        methods: {
            setDefaultTitle() {
                let self = this;
                if (self.issue.title == '') {
                    self.issue.title = 'Новая заявка';
                }
            },
            setCreatedTime() {
                let self = this;
                self.issue.created_at = moment().format('DD.MM.YYYY / HH:mm');
            },
            createIssue() {
                let self = this;
                if (!self.$v.$invalid) {
                    header.loading = true;
                    self.disabled = true;
                    axios.post('/api/v1/issues', self.issue)
                        .then(function (response) {
                            header.loading = false;
                            self.disabled = false;
                            toastr[response.data.status](response.data.message);
                            if (response.data.created) {
                                self.router.push({ name: 'issues.show', params: { id: response.data.issue.id } });
                            }
                        })
                        .catch(function () {
                            header.loading = false;
                            self.disabled = false;
                            toastr['error']('Произошла ошибка');
                        });
                } else {
                    toastr['error']('Неверно заполнены поля');
                }
            }
        },
        components: {
            UserInfo,
        }
    }
</script>
