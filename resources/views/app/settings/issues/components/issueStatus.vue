<template>
    <tr class="shadow-sm"
        :key="issueStatus.id">
        <td class="text-center">
            {{ issueStatus.id }}
        </td>
        <td>
            <a href="#" data-color="white"
               v-on:click.prevent="showEditIssueStatusForm(issueStatus, 1)"
               aria-haspopup="true"
               aria-expanded="false"
               data-toggle="tooltip"
               data-placement="top"
               data-original-title="Редактировать"
               class="button p-2 px-3 rounded-pill shadow-sm blue"
               v-bind:class="issueStatus.color.title">
                <span class="status white"
                      v-bind:class="issueStatus.icon.title">
                            {{ issueStatus.title }}
                        </span>
            </a>
        </td>
        <td class="description">
            <span v-bind:data-toggle="[issueStatus.description ? 'tooltip' : '']"
                  data-placement="top"
                  v-bind:data-original-title="[issueStatus.description ? issueStatus.description : '']">{{ getDescription(issueStatus.description) }}</span>
        </td>
        <td class="d-flex align-items-center justify-content-end pr-3">
            <div v-if="issueStatus.type.id !== 1"
                 class="modification shadow-sm"
                 data-toggle="tooltip"
                 data-placement="top"
                 v-bind:data-original-title="issueStatus.type.title"></div>
            <div ref="toggle"
                 data-toggle="tooltip"
                 data-placement="top"
                 v-bind:data-original-title="[issueStatus.active ? 'Выключить статус' : 'Активировать статус']"
                 class="ml-3 cursor-pointer"
                 v-bind:class="{active: issueStatus.active}"
                 v-bind:data-id="issueStatus.id"
                 v-on:click="toggleIssueStatusActive(issueStatus)"
                 style="height: 1.2rem; width: 1.2rem;"></div>
            <div ref="delete"
                 data-toggle="tooltip"
                 data-placement="top"
                 v-bind:data-original-title="[issueStatus.deleted_at ? 'Восстановить' : 'Удалить статус']"
                 class="ml-3 cursor-pointer"
                 v-on:click="issueStatus.deleted_at ? restoreIssueStatus(issueStatus) : removeIssueStatus(issueStatus)"
                 v-bind:data-id="issueStatus.id"
                 style="height: 1.2rem; width: 1.2rem;"></div>
        </td>
    </tr>
</template>

<script>
    import * as issueStatusToggleAnimation from "../../../../../animated-icons/toggle/toggle.json";
    import * as issueStatusDeleteAnimation from "../../../../../animated-icons/delete/delete.json";

    export default {
        props: {
            issueStatus: {},
        },
        data: function () {
            return {
                toggleAnim: null,
                deleteAnim: null,
                opportunity: null,
            }
        },
        mounted() {
            let self = this;
            self.toggleAnim = lottie.loadAnimation({
                container: self.$refs.toggle,
                autoplay: false,
                name: 'toggle' + self.issueStatus.id,
                animationData: issueStatusToggleAnimation.default
            });
            self.deleteAnim = lottie.loadAnimation({
                container: self.$refs.delete,
                autoplay: false,
                animationData: issueStatusDeleteAnimation.default
            });
            if (self.issueStatus.active) {
                lottie.goToAndStop(0, true, 'toggle' + self.issueStatus.id);
            } else {
                lottie.goToAndStop(12, true, 'toggle' + self.issueStatus.id);
            }
            $('[data-toggle="tooltip"]').tooltip();
        },
        updated() {
            let self = this;
            if (self.issueStatus.active) {
                self.toggleAnim.playSegments([12, 0], true);
            } else {
                self.toggleAnim.playSegments([0, 12], true);
            }
            $('[data-toggle="tooltip"]').tooltip('update');
        },
        methods: {
            getDescription: function (text = null) {
                let size = 25;
                if (text !== null && text.length > size) {
                    return text.slice(0, size) + ' ...';
                }
                return text;
            },
            toggleIssueStatusActive: function (issueStatus) {
                let self = this,
                    editedIssueStatus = {...issueStatus};
                header.loading = true;
                editedIssueStatus.active = !issueStatus.active;
                axios.put('/api/v1/issues/statuses/' + issueStatus.id, editedIssueStatus).then(function (response) {
                    header.loading = false;
                    self.disabled = false;
                    toastr[response.data.status](response.data.message);
                    if (response.data.updated) {
                        issueStatus.active = response.data.issueStatus.active;
                    }
                })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    })
            },
            showEditIssueStatusForm: function (issueStatus, index) {
                let self = this;
                self.$emit('show-issue-status-edit-form', {issueStatus, index});
            },
            removeIssueStatus: function (issueStatus) {
                let self = this;
                header.loading = true;
                self.disabled = true;
                axios.delete('/api/v1/issues/statuses/' + issueStatus.id)
                    .then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.removed) {
                            issueStatus.deleted_at = response.data.issueStatus.deleted_at;
                            self.deleteAnim.playSegments([0, 18], true);
                            self.opportunity = setTimeout(function () {
                                self.$emit('remove-issue-status');
                            }, 3000);
                        }
                    })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    });
            },
            restoreIssueStatus: function (issueStatus) {
                let self = this,
                    editedIssueStatus = {...issueStatus};
                header.loading = true;
                self.disabled = true;
                editedIssueStatus.deleted_at = null;
                axios.put('/api/v1/issues/statuses/' + issueStatus.id, editedIssueStatus)
                    .then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.updated) {
                            issueStatus.deleted_at = response.data.issueStatus.deleted_at;
                            self.deleteAnim.playSegments([17, 0], true);
                            clearTimeout(self.opportunity);
                        }
                    })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    });
            },
        }
    }
</script>
