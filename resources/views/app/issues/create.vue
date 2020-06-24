<template>
    <div class="row mb-4">
        <div class="col-7">
            <vue-headful
                v-bind:title="issue.title"
            />
            <div class="row mb-2">
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
            <div class="row mb-4">
                <div class="col">
                    <textarea></textarea>
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
            <div class="row mb-4" v-if="issue.updated_at">
                <div class="col">
                    <h6 class="text-gray">Дата обновления</h6>
                    <h5>{{ issue.updated_at }}</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Автор</h6>
                    <user-info v-if="issue.author" v-bind:users="issue.author"></user-info>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Ответственный</h6>
                    <user-info v-if="issue.employee" v-bind:users="issue.employee"></user-info>
                    <h5 v-else>Не назначен</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Тип заявки</h6>
                    <h5 v-if="issue.type">{{ issue.type.title }}</h5>
                    <h5 v-else="issue.type">Не назначен</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Приоритет заявки</h6>
                    <h5 v-if="issue.priority">{{ issue.priority.title }}</h5>
                    <h5 v-else="issue.priority">Не назначен</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <h6 class="text-gray">Наблюдатели</h6>
                    <div class="d-flex align-items-center" v-if="issue.observers">
                        <user-info v-if="issue.observers.length > 0" v-bind:users="issue.observers"></user-info>
                        <template v-else>
                            <h5>Наблюдателей нет</h5>
                        </template>
                    </div>
                    <h5 v-else>Наблюдателей нет</h5>
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
                    title: 'Новая заявка'
                },
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
            },
        },
        mounted() {
            let self = this;
        },
        methods: {
            setDefaultTitle() {
                let self = this;
                if (self.issue.title == '') {
                    self.issue.title = 'Новая заявка';
                }
            },
        },
        components: {
            UserInfo,
        }
    }
</script>
