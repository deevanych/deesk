<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <h3 class="font-weight-bold d-inline-block mb-0">Статусы</h3>
                    <a href="/"
                       v-on:click="showAddIssueStatusForm"
                       class="button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active"
                       data-toggle="modal" data-target="#addIssueStatus">
                        Добавить статус
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
                        <template v-if="issueStatuses">
                            <tr v-if="!issueStatuses.length">
                                <td colspan="4">Статусов заявок нет. Для работы на портале необходимо создать хотя бы 1
                                    статус.
                                </td>
                            </tr>
                            <transition-group name="list" tag="tbody">
                                <template v-if="issueStatuses.length">
                                    <template>
                                        <issue-status
                                            v-for="(issueStatus, key) in issueStatuses"
                                            v-bind:issue-status="issueStatus"
                                            v-bind:key="issueStatus.id"
                                            v-on:remove-issue-status="removeIssueStatus(key)"
                                            v-on:show-issue-status-edit-form="showEditForm(issueStatus, key)">
                                        </issue-status>
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
        <form class="modal fade" id="addIssueStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true" v-on:submit.prevent="addIssueStatus">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5 m-0">
                    <div class="modal-header px-0 pt-0 pb-4 border-0">
                        <h5 class="modal-title">Добавить статус</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="form">
                            <div class="form-group w-100">
                                <input type="text" required placeholder=" " v-model="issueStatus.title"/>
                                <span>
                                    <span>Название</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueStatus.title.required">(обязательное поле)</span>
                                    <span class="text-warning" v-if="!$v.issueStatus.title.minLength">(минимальная длина - {{$v.issueStatus.title.$params.minLength.min}} знака)</span>
                                </span>
                                <input type="text" class="helper"/>
                            </div>
                            <div class="form-group w-100">
                                <input type="text" placeholder=" " v-model="issueStatus.description"/>
                                <span>
                                    <span>Описание</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueStatus.description.maxLength">(максимальная длина - {{$v.issueStatus.description.$params.maxLength.max}} знаков)</span>
                                </span>
                                <input type="text" class="helper"/>
                            </div>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span class="required">Цвет</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueStatus.color_id.required">(обязательное поле)</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <div v-for="(issueStatusColor, key) in issueStatusColors"
                                         class="issue-status-color-choosing mr-3">
                                        <input type="radio"
                                               v-model="issueStatus.color_id" required class="d-none issue-status-color"
                                               v-bind:id="'color'+issueStatusColor.id" name="color_id"
                                               v-bind:value="issueStatusColor.id">
                                        <label v-bind:for="'color'+issueStatusColor.id"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               v-bind:data-original-title="issueStatusColor.description"
                                               class="button issue-status-color-choose rounded-circle shadow-sm cursor-pointer"
                                               v-bind:class="issueStatusColor.title"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span class="required">Иконка</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueStatus.icon_id.required">(обязательное поле)</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <div v-for="(issueStatusIcon, key) in issueStatusIcons"
                                         class="issue-status-icon-choosing mr-3">
                                        <input type="radio"
                                               v-model="issueStatus.icon_id" required class="d-none issue-status-icon"
                                               v-bind:id="'icon'+issueStatusIcon.id" name="icon_id"
                                               v-bind:value="issueStatusIcon.id">
                                        <label v-bind:for="'icon'+issueStatusIcon.id"
                                               class="button issue-status-icon-choose rounded-circle shadow-sm cursor-pointer"
                                               v-bind:class="issueStatusIcon.title"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <span class="position-relative">
                                    <span class="required">Модификатор статуса</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueStatus.type_id.required">(обязательное поле)</span>
                                </span>
                                <div>
                                    <div v-for="(issueStatusType, key) in issueStatusTypes"
                                         class="issue-status-type-choosing mr-3 d-flex align-items-center">
                                        <input type="radio"
                                               v-model="issueStatus.type_id" required class="d-none issue-status-type"
                                               v-bind:id="'type'+issueStatusType.id" name="type_id"
                                               v-bind:value="issueStatusType.id">
                                        <label v-bind:for="'type'+issueStatusType.id"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               v-bind:data-original-title="issueStatusType.description"
                                               class="issue-status-type-choose cursor-pointer mb-0 ml-1 radio-button">{{
                                            issueStatusType.title }}</label>
                                    </div>
                                </div>
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
              ref="editForm" id="editIssueStatus"
              tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
              v-on:submit.prevent="changeIssueStatus(editIssueStatusIndex)">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5 m-0">
                    <div class="modal-header px-0 pt-0 pb-4 border-0">
                        <h5 class="modal-title">Редактировать статус</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="form">
                            <div class="form-group w-100">
                                <input type="text" required placeholder=" " v-model="issueStatus.title"/>
                                <span>
                                    <span>Название</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueStatus.title.required">(обязательное поле)</span>
                                    <span class="text-warning" v-if="!$v.issueStatus.title.minLength">(минимальная длина - {{$v.issueStatus.title.$params.minLength.min}} знака)</span>
                                </span>
                                <input type="text" class="helper"/>
                            </div>
                            <div class="form-group w-100">
                                <input type="text" placeholder=" " v-model="issueStatus.description"/>
                                <span>
                                    <span>Описание</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueStatus.description.maxLength">(максимальная длина - {{$v.issueStatus.description.$params.maxLength.max}} знаков)</span>
                                </span>
                                <input type="text" class="helper"/>
                            </div>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span class="required">Цвет</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueStatus.color_id.required">(обязательное поле)</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <div v-for="(issueStatusColor, key) in issueStatusColors"
                                         class="issue-status-color-choosing mr-3">
                                        <input type="radio"
                                               v-model="issueStatus.color_id" required class="d-none issue-status-color"
                                               v-bind:id="'color'+issueStatusColor.id+'-edit'" name="color_id"
                                               v-bind:value="issueStatusColor.id">
                                        <label v-bind:for="'color'+issueStatusColor.id+'-edit'"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               v-bind:data-original-title="issueStatusColor.description"
                                               class="button issue-status-color-choose rounded-circle shadow-sm cursor-pointer"
                                               v-bind:class="issueStatusColor.title"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span class="required">Иконка</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueStatus.icon_id.required">(обязательное поле)</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <div v-for="(issueStatusIcon, key) in issueStatusIcons"
                                         class="issue-status-icon-choosing mr-3">
                                        <input type="radio"
                                               v-model="issueStatus.icon_id" required class="d-none issue-status-icon"
                                               v-bind:id="'icon'+issueStatusIcon.id+'-edit'" name="icon_id"
                                               v-bind:value="issueStatusIcon.id">
                                        <label v-bind:for="'icon'+issueStatusIcon.id+'-edit'"
                                               class="button issue-status-icon-choose rounded-circle shadow-sm cursor-pointer"
                                               v-bind:class="issueStatusIcon.title"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <span class="position-relative">
                                    <span class="required">Модификатор статуса</span>
                                    <span class="text-warning"
                                          v-if="!$v.issueStatus.type_id.required">(обязательное поле)</span>
                                </span>
                                <div>
                                    <div v-for="(issueStatusType, key) in issueStatusTypes"
                                         class="issue-status-type-choosing mr-3 d-flex align-items-center">
                                        <input type="radio"
                                               v-model="issueStatus.type_id" required class="d-none issue-status-type"
                                               v-bind:id="'type'+issueStatusType.id+'-edit'" name="type_id"
                                               v-bind:value="issueStatusType.id">
                                        <label v-bind:for="'type'+issueStatusType.id+'-edit'"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               v-bind:data-original-title="issueStatusType.description"
                                               class="issue-status-type-choose cursor-pointer mb-0 ml-1 radio-button">{{
                                            issueStatusType.title }}</label>
                                    </div>
                                </div>
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
    import issueStatus from "./components/issueStatus";
    import {required, minLength, maxLength} from "vuelidate/lib/validators";

    export default {
        data: function () {
            return {
                disabled: false,
                router: this.$router,
                issueStatuses: null,
                issueStatus: {},
                editIssueStatusIndex: null,
                issueStatusColors: null,
                issueStatusIcons: null,
                issueStatusTypes: null,
            }
        },
        validations: {
            issueStatus: {
                title: {
                    required,
                    minLength: minLength(4),
                    maxLength: maxLength(50)
                },
                description: {
                    maxLength: maxLength(50)
                },
                color_id: {
                    required,
                },
                icon_id: {
                    required,
                },
                type_id: {
                    required,
                }
            },
        },
        mounted() {
            let self = this;
            header.loading = true;
            axios.get('/api/v1/issues/statuses')
                .then(function (response) {
                    header.loading = false;
                    self.issueStatuses = response.data;
                });
            axios.get('/api/v1/issues/statuses/colors')
                .then(function (response) {
                    header.loading = false;
                    self.issueStatusColors = response.data;
                });
            axios.get('/api/v1/issues/statuses/icons')
                .then(function (response) {
                    header.loading = false;
                    self.issueStatusIcons = response.data;
                });
            axios.get('/api/v1/issues/statuses/types')
                .then(function (response) {
                    header.loading = false;
                    self.issueStatusTypes = response.data;
                });
            $('[data-toggle="tooltip"]').tooltip();
        },
        methods: {
            showAddIssueStatusForm: function (e) {
                let self = this;
                self.issueStatus = {
                    color_id: 1,
                    icon_id: 1,
                    type_id: 1,
                }
            },
            addIssueStatus: function (e) {
                let self = this;
                if (!self.$v.$invalid) {
                    header.loading = true;
                    self.disabled = true;
                    axios.post('/api/v1/issues/statuses', this.issueStatus)
                        .then(function (response) {
                            header.loading = false;
                            self.disabled = false;
                            toastr[response.data.status](response.data.message);
                            if (response.data.created) {
                                self.issueStatuses.push(response.data.issueStatus);
                                $(e.target).modal('toggle');
                                $(self.$refs.editForm).on('hidden.bs.modal', function (e) {
                                    self.issueStatus = {};
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
            changeIssueStatus: function () {
                let self = this;
                if (!self.$v.$invalid) {
                    header.loading = true;
                    self.disabled = true;
                    axios.put('/api/v1/issues/statuses/' + self.issueStatus.id, self.issueStatus).then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.updated) {
                            self.$set(self.issueStatuses, self.editIssueStatusIndex, response.data.issueStatus);
                            $(self.$refs.editForm).modal('toggle');
                            $(self.$refs.editForm).on('hidden.bs.modal', function (e) {
                                self.issueStatus = {};
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
            removeIssueStatus: function (issueStatusIndex) {
                let self = this;
                self.$delete(self.issueStatuses, issueStatusIndex);
            },
            showEditForm: function (issueStatus, issueStatusIndex) {
                let self = this;
                self.editIssueStatusIndex = issueStatusIndex;
                self.issueStatus = {...issueStatus};
                $(self.$refs.editForm).modal('toggle');
            }
        },
        components: {
            issueStatus
        }
    }
</script>

