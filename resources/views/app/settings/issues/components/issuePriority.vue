<template>
    <tr class="shadow-sm"
        :key="issuePriority.id">
        <td class="text-center">
            {{ issuePriority.id }}
        </td>
        <td>
            <a href="#"
               v-on:click.prevent="showEditIssuePriorityForm(issuePriority, 1)"
               data-toggle="tooltip"
               data-placement="top"
               data-original-title="Редактировать">
                {{ issuePriority.title }}
            </a>
        </td>
        <td class="description">
            <span v-bind:data-toggle="[issuePriority.description ? 'tooltip' : '']"
                  data-placement="top"
                  v-bind:data-original-title="[issuePriority.description ? issuePriority.description : '']">{{ getDescription(issuePriority.description) }}</span>
        </td>
        <td class="d-flex align-items-center justify-content-end pr-3">
            <div ref="toggle"
                 data-toggle="tooltip"
                 data-placement="top"
                 v-bind:data-original-title="[issuePriority.active ? 'Выключить приоритет' : 'Активировать приоритет']"
                 class="cursor-pointer"
                 v-bind:class="{active: issuePriority.active}"
                 v-bind:data-id="issuePriority.id"
                 v-on:click="toggleIssuePriorityActive(issuePriority)"
                 style="height: 1.2rem; width: 1.2rem;"></div>
            <div ref="delete"
                 data-toggle="tooltip"
                 data-placement="top"
                 v-bind:data-original-title="[issuePriority.deleted_at ? 'Восстановить' : 'Удалить приоритет']"
                 class="ml-3 cursor-pointer"
                 v-on:click="issuePriority.deleted_at ? restoreIssuePriority(issuePriority) : removeIssuePriority(issuePriority)"
                 v-bind:data-id="issuePriority.id"
                 style="height: 1.2rem; width: 1.2rem;"></div>
        </td>
    </tr>
</template>

<script>
    import * as issuePriorityToggleAnimation from "../../../../../animated-icons/toggle/toggle.json";
    import * as issuePriorityDeleteAnimation from "../../../../../animated-icons/delete/delete.json";

    export default {
        props: {
            issuePriority: {},
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
                name: 'toggle' + self.issuePriority.id,
                animationData: issuePriorityToggleAnimation.default
            });
            self.deleteAnim = lottie.loadAnimation({
                container: self.$refs.delete,
                autoplay: false,
                animationData: issuePriorityDeleteAnimation.default
            });
            if (self.issuePriority.active) {
                lottie.goToAndStop(0, true, 'toggle' + self.issuePriority.id);
            } else {
                lottie.goToAndStop(12, true, 'toggle' + self.issuePriority.id);
            }
            $('[data-toggle="tooltip"]').tooltip();
        },
        updated() {
            let self = this;
            if (self.issuePriority.active) {
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
            toggleIssuePriorityActive: function (issuePriority) {
                let self = this,
                    editedIssuePriority = {...issuePriority};
                header.loading = true;
                editedIssuePriority.active = !issuePriority.active;
                axios.put('/api/v1/issues/priorities/' + issuePriority.id, editedIssuePriority).then(function (response) {
                    header.loading = false;
                    self.disabled = false;
                    toastr[response.data.status](response.data.message);
                    if (response.data.updated) {
                        issuePriority.active = response.data.issuePriority.active;
                    }
                })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    })
            },
            showEditIssuePriorityForm: function (issuePriority, index) {
                let self = this;
                self.$emit('show-issue-priority-edit-form', {issuePriority, index});
            },
            removeIssuePriority: function (issuePriority) {
                let self = this;
                header.loading = true;
                self.disabled = true;
                axios.delete('/api/v1/issues/priorities/' + issuePriority.id)
                    .then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.removed) {
                            issuePriority.deleted_at = response.data.issuePriority.deleted_at;
                            self.deleteAnim.playSegments([0, 18], true);
                            self.opportunity = setTimeout(function () {
                                self.$emit('remove-issue-priority');
                            }, 3000);
                        }
                    })
                    .catch(function () {
                        header.loading = false;
                        self.disabled = false;
                        toastr['error']('Произошла ошибка');
                    });
            },
            restoreIssuePriority: function (issuePriority) {
                let self = this,
                    editedIssuePriority = {...issuePriority};
                header.loading = true;
                self.disabled = true;
                editedIssuePriority.deleted_at = null;
                axios.put('/api/v1/issues/priorities/' + issuePriority.id, editedIssuePriority)
                    .then(function (response) {
                        header.loading = false;
                        self.disabled = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.updated) {
                            issuePriority.deleted_at = response.data.issuePriority.deleted_at;
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
