<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <h3 class="font-weight-bold d-inline-block mb-0">Типы</h3>
                    <a href="/"
                       v-on:click="issueType = {}"
                       class="button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active"
                       data-toggle="modal" data-target="#addIssueType">
                        Добавить тип
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <table class="table">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th></th>
                        </tr>
                        <template v-if="issueTypes">
                            <tr v-if="!issueTypes.length">
                                <td colspan="4">Типов заявок нет. Для работы на портале необходимо создать хотя бы 1
                                    тип.
                                </td>
                            </tr>
                            <transition-group name="list" tag="tbody">
                                <template v-if="issueTypes.length">
                                    <template>
                                        <issue-type
                                            v-for="(issueType, key) in issueTypes"
                                            v-bind:issue-type="issueType"
                                            v-bind:key="issueType.id"
                                            v-on:remove-issue-type="removeIssueType(key)"
                                            v-on:show-issue-type-edit-form="showEditForm(issueType, key)">
                                        </issue-type>
                                    </template>
                                </template>
                            </transition-group>
                        </template>
                        <template v-else>
                            <tr v-for="n in 4">
                                <td v-for="n in 4">
                                    <PuSkeleton width="100%" height="1rem"></PuSkeleton>
                                </td>
                            </tr>
                        </template>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <form class="modal fade" id="addIssueType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true" v-on:submit.prevent="addIssueType">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5 m-0">
                    <div class="modal-header px-0 pt-0 pb-4 border-0">
                        <h5 class="modal-title">Добавить тип</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="form">
                            <div class="form-group w-100">
                                <input type="text" required placeholder=" " v-model="issueType.title"/>
                                <span>
                                    <span>Название</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueType.title.required">(обязательное поле)</span>
                                    <span class="text-warning" v-if="!$v.issueType.title.minLength">(минимальная длина - {{$v.issueType.title.$params.minLength.min}} знака)</span>
                                </span>
                                <input type="text" class="helper"/>
                            </div>
                            <div class="form-group w-100">
                                <input type="text" placeholder=" " v-model="issueType.description"/>
                                <span>
                                    <span>Описание</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueType.description.maxLength">(максимальная длина - {{$v.issueType.description.$params.maxLength.max}} знаков)</span>
                                </span>
                                <input type="text" class="helper"/>
                            </div>
                        </div>
                        <div class="annotations mb-3">
                            <small><span class="text-danger">*</span> - поля, обязательные для заполнения</small>
                        </div>
                    </div>
                    <div class="modal-footer p-0">
                        <button data-dismiss="modal"
                                class="button p-3 px-4 rounded-pill shadow-sm white">
                            Отмена
                        </button>
                        <button
                            type="submit"
                            class="ml-3 button p-3 px-4 rounded-pill shadow-sm tonight green"
                            :disabled="disabled">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <form class="modal fade"
              ref="editForm" id="editIssueType"
              tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
              v-on:submit.prevent="changeIssueType(editIssueTypeIndex)">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5 m-0">
                    <div class="modal-header px-0 pt-0 pb-4 border-0">
                        <h5 class="modal-title">Редактировать тип</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="form">
                            <div class="form-group w-100">
                                <input type="text" required placeholder=" " v-model="issueType.title"/>
                                <span>
                                    <span>Название</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueType.title.required">(обязательное поле)</span>
                                    <span class="text-warning" v-if="!$v.issueType.title.minLength">(минимальная длина - {{$v.issueType.title.$params.minLength.min}} знака)</span>
                                </span>
                                <input type="text" class="helper"/>
                            </div>
                            <div class="form-group w-100">
                                <input type="text" placeholder=" " v-model="issueType.description"/>
                                <span>
                                    <span>Описание</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueType.description.maxLength">(максимальная длина - {{$v.issueType.description.$params.maxLength.max}} знаков)</span>
                                </span>
                                <input type="text" class="helper"/>
                            </div>
                        </div>
                        <div class="annotations mb-3">
                            <small><span class="text-danger">*</span> - поля, обязательные для заполнения</small>
                        </div>
                    </div>
                    <div class="modal-footer p-0">
                        <button data-dismiss="modal"
                                class="button p-3 px-4 rounded-pill shadow-sm white">
                            Отмена
                        </button>
                        <button
                            type="submit"
                            class="ml-3 button p-3 px-4 rounded-pill shadow-sm tonight green"
                            :disabled="disabled">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import issueType from "./components/issueType";
    import {required, minLength, maxLength} from "vuelidate/lib/validators";

    export default {
        data: function () {
            return {
                disabled: false,
                router: this.$router,
                issueTypes: null,
                issueType: {},
                editIssueTypeIndex: null,
            }
        },
        validations: {
            issueType: {
                title: {
                    required,
                    minLength: minLength(4),
                    maxLength: maxLength(50)
                },
                description: {
                    maxLength: maxLength(50)
                }
            },
        },
        mounted() {
            let self = this;
            header.loading = true;
            axios.get('/api/v1/issues/types')
                .then(function (response) {
                    header.loading = false;
                    self.issueTypes = response.data;
                });
        },
        methods: {
            addIssueType: function (e) {
                let self = this;
                if (!self.$v.$invalid) {
                    header.loading = true;
                    self.disabled = true;
                    axios.post('/api/v1/issues/types', this.issueType)
                        .then(function (response) {
                            header.loading = false;
                            self.disabled = false;
                            toastr[response.data.status](response.data.message);
                            if (response.data.created) {
                                self.issueTypes.push(response.data.issueType);
                                $(e.target).modal('toggle');
                                self.issueType = {};
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
            },
            changeIssueType: function () {
                let self = this;
                if (!self.$v.$invalid) {
                    header.loading = true;
                    self.disabled = true;
                    axios.put('/api/v1/issues/types/' + self.issueType.id, self.issueType).then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.updated) {
                            self.$set(self.issueTypes, self.editIssueTypeIndex, response.data.issueType);
                            $(self.$refs.editForm).modal('toggle');
                            self.issueType = {};
                        }
                    })
                        .catch(function () {
                            header.loading = false;
                            self.disabled = false;
                            toastr['error']('Произошла ошибка');
                        })
                } else {
                    toastr['error']('Неверно заполнены поля');
                }
            },
            removeIssueType: function (issueTypeIndex) {
                let self = this;
                self.$delete(self.issueTypes, issueTypeIndex);
            },
            showEditForm: function (issueType, issueTypeIndex) {
                let self = this;
                self.editIssueTypeIndex = issueTypeIndex;
                self.issueType = {...issueType};
                $(self.$refs.editForm).modal('toggle');
            }
        },
        components: {
            issueType
        }
    }
</script>
