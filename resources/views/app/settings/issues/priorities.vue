<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <h3 class="font-weight-bold d-inline-block mb-0">Приоритеты</h3>
                    <a href="/"
                       v-on:click="issuePriority = {}"
                       class="button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active"
                       data-toggle="modal" data-target="#addIssueType">
                        Добавить приоритет
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
                        <template v-if="issuePriorities">
                            <tr v-if="!issuePriorities.length">
                                <td colspan="4">Приоритетов заявок нет. Для работы на портале необходимо создать хотя бы 1
                                    приоритет.
                                </td>
                            </tr>
                            <transition-group name="list" tag="tbody">
                                <template v-if="issuePriorities.length">
                                    <template>
                                        <issue-priority
                                            v-for="(issuePriority, key) in issuePriorities"
                                            v-bind:issue-priority="issuePriority"
                                            v-bind:key="issuePriority.id"
                                            v-on:remove-issue-priority="removeIssuePriority(key)"
                                            v-on:show-issue-priority-edit-form="showEditForm(issuePriority, key)">
                                        </issue-priority>
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
              aria-hidden="true" v-on:submit.prevent="addIssuePriority">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5 m-0">
                    <div class="modal-header px-0 pt-0 pb-4 border-0">
                        <h5 class="modal-title">Добавить приоритет</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="form">
                            <div class="form-group w-100">
                                <input type="text" required placeholder=" " v-model="issuePriority.title"/>
                                <span>
                                    <span>Название</span>
                                    <span class="text-warning"
                                          v-if="!$v.issuePriority.title.required">(обязательное поле)</span>
                                    <span class="text-warning" v-if="!$v.issuePriority.title.minLength">(минимальная длина - {{$v.issuePriority.title.$params.minLength.min}} знака)</span>
                                </span>
                                <input type="text" class="helper"/>
                            </div>
                            <div class="form-group w-100">
                                <input type="text" placeholder=" " v-model="issuePriority.description"/>
                                <span>
                                    <span>Описание</span>
                                    <span class="text-warning"
                                          v-if="!$v.issuePriority.description.maxLength">(максимальная длина - {{$v.issuePriority.description.$params.maxLength.max}} знаков)</span>
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
              v-on:submit.prevent="changeIssuePriority(editIssuePriorityIndex)">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5 m-0">
                    <div class="modal-header px-0 pt-0 pb-4 border-0">
                        <h5 class="modal-title">Редактировать приоритет</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="form">
                            <div class="form-group w-100">
                                <input type="text" required placeholder=" " v-model="issuePriority.title"/>
                                <span>
                                    <span>Название</span>
                                    <span class="text-warning"
                                          v-if="!$v.issuePriority.title.required">(обязательное поле)</span>
                                    <span class="text-warning" v-if="!$v.issuePriority.title.minLength">(минимальная длина - {{$v.issuePriority.title.$params.minLength.min}} знака)</span>
                                </span>
                                <input type="text" class="helper"/>
                            </div>
                            <div class="form-group w-100">
                                <input type="text" placeholder=" " v-model="issuePriority.description"/>
                                <span>
                                    <span>Описание</span>
                                    <span class="text-warning"
                                          v-if="!$v.issuePriority.description.maxLength">(максимальная длина - {{$v.issuePriority.description.$params.maxLength.max}} знаков)</span>
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
    import issuePriority from "./components/issuePriority";
    import {required, minLength, maxLength} from "vuelidate/lib/validators";

    export default {
        data: function () {
            return {
                disabled: false,
                router: this.$router,
                issuePriorities: null,
                issuePriority: {},
                editIssuePriorityIndex: null,
            }
        },
        validations: {
            issuePriority: {
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
            axios.get('/api/v1/issues/priorities?withDeleted=true')
                .then(function (response) {
                    header.loading = false;
                    self.issuePriorities = response.data;
                });
        },
        methods: {
            addIssuePriority: function (e) {
                let self = this;
                if (!self.$v.$invalid) {
                    header.loading = true;
                    self.disabled = true;
                    axios.post('/api/v1/issues/priorities', this.issuePriority)
                        .then(function (response) {
                            header.loading = false;
                            self.disabled = false;
                            toastr[response.data.status](response.data.message);
                            if (response.data.created) {
                                self.issuePriorities.push(response.data.issuePriority);
                                $(e.target).modal('toggle');
                                $(self.$refs.editForm).on('hidden.bs.modal', function (e) {
                                    self.issuePriority = {};
                                })
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
            changeIssuePriority: function () {
                let self = this;
                if (!self.$v.$invalid) {
                    header.loading = true;
                    self.disabled = true;
                    axios.put('/api/v1/issues/priorities/' + self.issuePriority.id, self.issuePriority).then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.updated) {
                            self.$set(self.issuePriorities, self.editIssuePriorityIndex, response.data.issuePriority);
                            $(self.$refs.editForm).modal('toggle');
                            $(self.$refs.editForm).on('hidden.bs.modal', function (e) {
                                self.issuePriority = {};
                            })
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
            removeIssuePriority: function (issuePriorityIndex) {
                let self = this;
                self.$delete(self.issuePriorities, issuePriorityIndex);
            },
            showEditForm: function (issuePriority, issuePriorityIndex) {
                let self = this;
                self.editIssuePriorityIndex = issuePriorityIndex;
                self.issuePriority = {...issuePriority};
                $(self.$refs.editForm).modal('toggle');
            }
        },
        components: {
            issuePriority
        }
    }
</script>
