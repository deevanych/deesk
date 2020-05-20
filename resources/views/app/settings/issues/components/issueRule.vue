<template>
    <tr class="shadow-sm"
        :key="issueRule.id">
        <td class="text-center">
            {{ issueRule.id }}
        </td>
        <td class="hover-grow">
            <a href="#"
               v-on:click.prevent="showEditIssueRuleForm(issueRule, 1)"
               data-toggle="tooltip"
               data-placement="top"
               data-html="true"
               v-bind:data-original-title="getDefiningTooltip(issueRule)">
                {{ getDefiningTitle(issueRule) }}
            </a>
        </td>
        <td class="hover-grow description">
            <span>{{ getAdjustedTitle(issueRule) }}</span>
        </td>
        <td class="d-flex align-items-center justify-content-end pr-3">
            <div ref="toggle"
                 data-toggle="tooltip"
                 data-placement="top"
                 v-bind:data-original-title="[issueRule.active ? 'Выключить правило' : 'Активировать правило']"
                 class="cursor-pointer"
                 v-bind:class="{active: issueRule.active}"
                 v-bind:data-id="issueRule.id"
                 v-on:click="toggleIssueRuleActive(issueRule)"
                 style="height: 1.2rem; width: 1.2rem;"></div>
            <div ref="delete"
                 data-toggle="tooltip"
                 data-placement="top"
                 v-bind:data-original-title="[issueRule.deleted_at ? 'Восстановить' : 'Удалить правило']"
                 class="ml-3 cursor-pointer"
                 v-on:click="issueRule.deleted_at ? restoreIssueRule(issueRule) : removeIssueRule(issueRule)"
                 v-bind:data-id="issueRule.id"
                 style="height: 1.2rem; width: 1.2rem;"></div>
        </td>
    </tr>
</template>

<script>
    import * as issueRuleToggleAnimation from "../../../../../animated-icons/toggle/toggle.json";
    import * as issueRuleDeleteAnimation from "../../../../../animated-icons/delete/delete.json";

    export default {
        props: {
            issueRule: {},
        },
        data: function () {
            return {
                toggleAnim: null,
                deleteAnim: null,
            }
        },
        mounted() {
            let self = this;
            self.toggleAnim = lottie.loadAnimation({
                container: self.$refs.toggle,
                autoplay: false,
                name: 'toggle' + self.issueRule.id,
                animationData: issueRuleToggleAnimation.default
            });
            self.deleteAnim = lottie.loadAnimation({
                container: self.$refs.delete,
                autoplay: false,
                animationData: issueRuleDeleteAnimation.default
            });
            if (self.issueRule.active) {
                lottie.goToAndStop(0, true, 'toggle' + self.issueRule.id);
            } else {
                lottie.goToAndStop(12, true, 'toggle' + self.issueRule.id);
            }
            $('[data-toggle="tooltip"]').tooltip();
        },
        updated() {
            let self = this;
            if (self.issueRule.active) {
                self.toggleAnim.playSegments([12, 0], true);
            } else {
                self.toggleAnim.playSegments([0, 12], true);
            }
            $('[data-toggle="tooltip"]').tooltip('update');
        },
        methods: {
            getDefiningTooltip: function (issueRule) {
                let text = '';
                text += '<b>Тип:</b> ' + (issueRule.issue_type !== null ? issueRule.issue_type.title : 'Любой');
                text += '<br/><b>Приоритет:</b> ' + (issueRule.issue_priority !== null ? issueRule.issue_priority.title : 'Любой');
                text += '<br/><b>Клиент:</b> ' + (issueRule.issue_client !== null ? issueRule.issue_client.title : 'Любой');
                return text;
            },
            getDefiningTitle: function(issueRule) {
                let text = [];
                if (issueRule.issue_type !== null) {
                    text.push('Тип');
                }
                if (issueRule.issue_priority !== null) {
                    text.push('Приоритет');
                }
                if (issueRule.issue_client !== null) {
                    text.push('Клиент');
                }
                if (text.length == 0) {
                    text.push('Не задано');
                }
                return text.join(', ');
            },
            getAdjustedTitle: function(issueRule) {
                let text = [];
                if (issueRule.issue_employee !== null) {
                    text.push('Ответственный');
                }
                if (issueRule.observer_ids.length != 0) {
                    text.push('Наблюдатели');
                }
                if (text.length == 0) {
                    text.push('Не задано');
                }
                return text.join(', ');
            },
            getDescription: function (text = null) {
                let size = 25;
                if (text !== null && text.length > size) {
                    return text.slice(0, size) + ' ...';
                }
                return text;
            }
            ,
            toggleIssueRuleActive: function (issueRule) {
                let self = this,
                    editedIssueRule = {...issueRule};
                header.loading = true;
                editedIssueRule.active = !issueRule.active;
                axios.put('/api/v1/issues/rules/' + issueRule.id, editedIssueRule).then(function (response) {
                    header.loading = false;
                    self.disabled = false;
                    toastr[response.data.status](response.data.message);
                    if (response.data.updated) {
                        issueRule.active = response.data.issueRule.active;
                    }
                })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    })
            }
            ,
            showEditIssueRuleForm: function (issueRule, index) {
                let self = this;
                self.$emit('show-issue-rule-edit-form', {issueRule, index});
            }
            ,
            removeIssueRule: function (issueRule) {
                let self = this;
                header.loading = true;
                self.disabled = true;
                axios.delete('/api/v1/issues/rules/' + issueRule.id)
                    .then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.removed) {
                            issueRule.deleted_at = response.data.issueRule.deleted_at;
                            self.deleteAnim.playSegments([0, 18], true);
                            self.opportunity = setTimeout(function () {
                                self.$emit('remove-issue-rule');
                            }, 3000);
                        }
                    })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    });
            }
            ,
            restoreIssueRule: function (issueRule) {
                let self = this,
                    editedIssueRule = {...issueRule};
                header.loading = true;
                self.disabled = true;
                editedIssueRule.deleted_at = null;
                axios.put('/api/v1/issues/rules/' + issueRule.id, editedIssueRule)
                    .then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.updated) {
                            issueRule.deleted_at = response.data.issueRule.deleted_at;
                            self.deleteAnim.playSegments([17, 0], true);
                            clearTimeout(self.opportunity);
                        }
                    })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    });
            }
            ,
        }
    }
</script>
