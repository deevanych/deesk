<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <h3 class="font-weight-bold d-inline-block mb-0">Правила</h3>
                    <a href="/"
                       v-on:click="showAddIssueRuleForm"
                       class="button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active"
                       data-toggle="modal" data-target="#addIssueRule">
                        Добавить правило
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <table class="table">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Если (заданы)</th>
                            <th>То (назначаются)</th>
                            <th></th>
                        </tr>
                        <template v-if="issueRules">
                            <tr v-if="!issueRules.length">
                                <td colspan="4">Правил для заявок нет.</td>
                            </tr>
                            <transition-group name="list" tag="tbody">
                                <template v-if="issueRules.length">
                                    <issue-rule
                                        v-for="(issueRule, key) in issueRules"
                                        v-bind:issue-rule="issueRule"
                                        v-bind:key="issueRule.id"
                                        v-on:remove-issue-rule="removeIssueRule(key)"
                                        v-on:show-issue-rule-edit-form="showEditForm(issueRule, key)">
                                    </issue-rule>
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
        <form class="modal fade" id="addIssueRule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true" v-on:submit.prevent="addIssueRule">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5 m-0">
                    <div class="modal-header px-0 pt-0 pb-4 border-0">
                        <h5 class="modal-title">Добавить правило</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="form">
                            <h6 class="px-0 mb-2">Если</h6>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Тип</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="issueRule.issue_type_id"
                                        v-bind="{values: issueTypes, name: 'issue_type_id', nullable: true, nullTitle: 'Любой'}"></select2>
                                </div>
                            </div>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Приоритет</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="issueRule.issue_priority_id"
                                        v-bind="{values: issuePriorities, name: 'issue_priority_id', nullable: true, nullTitle: 'Любой'}"></select2>
                                </div>
                            </div>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Клиент</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="issueRule.client_id"
                                        v-bind="{values: clients, name: 'client_id', nullable: true, nullTitle: 'Любой'}"></select2>
                                </div>
                            </div>
                            <h6 class="px-0 mb-2">То</h6>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Ответственный</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="issueRule.employee_id"
                                        v-bind="{values: employees, name: 'employee_id', nullable: true, nullTitle: 'Любой', groups: true}"></select2>
                                </div>
                            </div>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Наблюдатели</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="issueRule.observer_ids"
                                        v-bind="{values: employees, name: 'observers[]', nullable: false, nullTitle: 'Любой', multiple: true, groups: true}"></select2>
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
              ref="editForm" id="editIssueRule"
              tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
              v-on:submit.prevent="changeIssueRule(editIssueRuleIndex)">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5 m-0">
                    <div class="modal-header px-0 pt-0 pb-4 border-0">
                        <h5 class="modal-title">Добавить правило</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="form">
                            <h6 class="px-0 mb-2">Если</h6>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Тип</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="issueRule.issue_type_id"
                                        v-bind="{values: issueTypes, name: 'issue_type_id', nullable: true, nullTitle: 'Любой'}"></select2>
                                </div>
                            </div>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Приоритет</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="issueRule.issue_priority_id"
                                        v-bind="{values: issuePriorities, name: 'issue_priority_id', nullable: true, nullTitle: 'Любой'}"></select2>
                                </div>
                            </div>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Клиент</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="issueRule.client_id"
                                        v-bind="{values: clients, name: 'client_id', nullable: true, nullTitle: 'Любой'}"></select2>
                                </div>
                            </div>
                            <h6 class="px-0 mb-2">То</h6>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Ответственный</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="issueRule.employee_id"
                                        v-bind="{values: employees, name: 'employee_id', nullable: true, nullTitle: 'Любой', groups: true}"></select2>
                                </div>
                            </div>
                            <div class="form-group w-100 mb-2">
                                <span class="position-relative">
                                    <span>Наблюдатели</span>
                                </span>
                                <div class="d-flex flex-row">
                                    <select2
                                        v-model="issueRule.observer_ids"
                                        v-bind="{values: employees, name: 'observer_ids[]', nullable: false, nullTitle: 'Любой', multiple: true, groups: true}"></select2>
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
    import issueRule from "./components/issueRule";

    export default {
        components: {
            issueRule
        },
        data: function () {
            return {
                disabled: false,
                router: this.$router,
                issueRules: null,
                issueTypes: null,
                issuePriorities: null,
                clients: null,
                employees: null,
                editIssueRuleIndex: null,
                issueRule: {
                    issue_type_id: null,
                    issue_priority_id: null,
                    employee_id: null,
                    client_id: null,
                    observer_ids: [],
                },
            }
        },
        mounted() {
            let self = this;
            header.loading = true;
            axios.get('/api/v1/issues/rules')
                .then(function (response) {
                    header.loading = false;
                    self.issueRules = response.data;
                });
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
            axios.get('/api/v1/organizations')
                .then(function (response) {
                    header.loading = false;
                    self.clients = response.data;
                });
            axios.get('/api/v1/users')
                .then(function (response) {
                    header.loading = false;
                    self.employees = response.data;
                });
            $('[data-toggle="tooltip"]').tooltip();
            $('.modal').on()
        },
        methods: {
            showAddIssueRuleForm: function (e) {
                let self = this;
                self.issueRule = {
                    issue_type_id: null,
                    issue_priority_id: null,
                    employee_id: null,
                    client_id: null,
                    observer_ids: [],
                }
            },
            removeIssueRule: function (issueRuleIndex) {
                let self = this;
                self.$delete(self.issueRules, (issueRuleIndex));
            },
            showEditForm: function (issueRule, issueRuleIndex) {
                let self = this;
                self.editIssueRuleIndex = issueRuleIndex;
                self.issueRule = {...issueRule};
                $(self.$refs.editForm).modal('toggle');
            },
            changeIssueRule: function () {
                let self = this;
                header.loading = true;
                self.disabled = true;
                axios.put('/api/v1/issues/rules/' + self.issueRule.id, self.issueRule).then(function (response) {
                    header.loading = false;
                    self.disabled = false;
                    toastr[response.data.status](response.data.message);
                    if (response.data.updated) {
                        self.$set(self.issueRules, self.editIssueRuleIndex, response.data.issueRule);
                        $(self.$refs.editForm).modal('toggle');
                        $(self.$refs.editForm).on('hidden.bs.modal', function (e) {
                            self.issueRule = {
                                issue_type_id: null,
                                issue_priority_id: null,
                                employee_id: null,
                                client_id: null,
                                observer_ids: [],
                            }
                        })
                    }
                })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    });
            },
            addIssueRule: function (e) {
                let self = this;
                axios.post('/api/v1/issues/rules', self.issueRule)
                    .then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.created) {
                            self.issueRules.push(response.data.issueRule);
                            $(e.target).modal('toggle');
                            $(self.$refs.editForm).on('hidden.bs.modal', function (e) {
                                self.issueRule = {
                                    type: null,
                                    priority: null,
                                    employee: null,
                                    client: null,
                                    observer_ids: null,
                                };
                            })
                        }
                    });
            }
        },
    }
</script>

