<template>
    <tr class="shadow-sm"
        :key="issueType.id">
        <td class="text-center">
            {{ issueType.id }}
        </td>
        <td>
            <a href="#"
               v-on:click.prevent="showEditIssueTypeForm(issueType, 1)"
               data-toggle="tooltip"
               data-placement="top"
               data-original-title="Редактировать">
                {{ issueType.title }}
            </a>
        </td>
        <td class="description"
            v-bind:data-toggle="[issueType.description.length > 25 ? 'tooltip' : '']"
            data-placement="top"
            v-bind:data-original-title="[issueType.description.length > 25 ? issueType.description : '']">
            {{ getDescription(issueType.description) }}
        </td>
        <td class="d-flex align-items-center justify-content-end pr-3">
            <div ref="toggle"
                 data-toggle="tooltip"
                 data-placement="top"
                 v-bind:data-original-title="[issueType.active ? 'Выключить тип' : 'Активировать тип']"
                 class="cursor-pointer"
                 v-bind:class="{active: issueType.active}"
                 v-bind:data-id="issueType.id"
                 v-on:click="toggleIssueTypeActive(issueType)"
                 style="height: 1.2rem; width: 1.2rem;"></div>
            <div ref="delete"
                 data-toggle="tooltip"
                 data-placement="top"
                 v-bind:data-original-title="[issueType.deleted_at ? 'Восстановить' : 'Удалить тип']"
                 class="ml-3 cursor-pointer"
                 v-on:click="issueType.deleted_at ? restoreIssueType(issueType) : removeIssueType(issueType)"
                 v-bind:data-id="issueType.id"
                 style="height: 1.2rem; width: 1.2rem;"></div>
        </td>
    </tr>
</template>

<script>
    import * as issueTypeToggleAnimation from "../../../../../animated-icons/toggle/toggle.json";
    import * as issueTypeDeleteAnimation from "../../../../../animated-icons/delete/delete.json";

    export default {
        props: {
            issueType: {},
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
                name: 'toggle' + self.issueType.id,
                animationData: issueTypeToggleAnimation.default
            });
            self.deleteAnim = lottie.loadAnimation({
                container: self.$refs.delete,
                autoplay: false,
                animationData: issueTypeDeleteAnimation.default
            });
            if (self.issueType.active) {
                lottie.goToAndStop(0, true, 'toggle' + self.issueType.id);
            } else {
                lottie.goToAndStop(12, true, 'toggle' + self.issueType.id);
            }
            $('[data-toggle="tooltip"]').tooltip();
        },
        updated() {
            let self = this;
            if (self.issueType.active) {
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
            toggleIssueTypeActive: function (issueType) {
                let self = this;
                header.loading = true;
                axios.put('/api/v1/issues/types/' + issueType.id, {
                    active: !issueType.active
                }).then(function (response) {
                    header.loading = false;
                    self.disabled = false;
                    toastr[response.data.status](response.data.message);
                    if (response.data.updated) {
                        issueType.active = response.data.issueType.active;
                    }
                })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    })
            },
            showEditIssueTypeForm: function (issueType, index) {
                let self = this;
                self.$emit('show-issue-type-edit-form', {issueType, index});
            },
            removeIssueType: function (issueType) {
                let self = this;
                header.loading = true;
                self.disabled = true;
                axios.delete('/api/v1/issues/types/' + issueType.id)
                    .then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.removed) {
                            issueType.deleted_at = response.data.issueType.deleted_at;
                            self.deleteAnim.playSegments([0, 18], true);
                            self.opportunity = setTimeout(function () {
                                self.$emit('remove-issue-type');
                            }, 3000);
                        }
                    })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    });
            },

            restoreIssueType: function (issueType) {
                let self = this;
                header.loading = true;
                self.disabled = true;
                axios.put('/api/v1/issues/types/' + issueType.id, {
                    'deleted_at': null
                })
                    .then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.updated) {
                            issueType.deleted_at = response.data.issueType.deleted_at;
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
