<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <h3 class="font-weight-bold d-inline-block mb-0">Типы</h3>
                    <a href="/"
                       class="button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active"
                       data-toggle="modal" data-target="#exampleModal">
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
                        <template v-if="types">
                            <tr class="shadow-sm" v-for="type in types">
                                <td class="text-center">{{ type.id }}</td>
                                <td><a href="#">{{ type.title }}</a></td>
                                <td class="description">{{ getDescription(type.description) }}</td>
                                <td>
                                    <span>
                                        <svg aria-hidden="true" focusable="false" data-prefix="far"
                                             data-icon="check-square" role="img" height="1rem"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 448 512" class="svg-inline--fa fa-check-square fa-w-14 fa-2x"><path
                                            fill="currentColor"
                                            d="M400 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm0 400H48V80h352v352zm-35.864-241.724L191.547 361.48c-4.705 4.667-12.303 4.637-16.97-.068l-90.781-91.516c-4.667-4.705-4.637-12.303.069-16.971l22.719-22.536c4.705-4.667 12.303-4.637 16.97.069l59.792 60.277 141.352-140.216c4.705-4.667 12.303-4.637 16.97.068l22.536 22.718c4.667 4.706 4.637 12.304-.068 16.971z"
                                            class=""></path></svg>
                                    </span>
                                    <span>
                                        <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit"
                                             role="img" height="1rem" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 576 512"
                                             class="svg-inline--fa fa-edit fa-w-18 fa-2x">
                                            <path fill="currentColor"
                                                  d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"
                                                  class=""></path>
                                        </svg>
                                    </span>
                                    <span>
                                        <svg aria-hidden="true" focusable="false" data-prefix="far"
                                             data-icon="trash-alt" height="1rem" role="img"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14 fa-2x"><path
                                            fill="currentColor"
                                            d="M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z"
                                            class=""></path></svg>
                                    </span>
                                </td>
                            </tr>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content shadow-sm p-5">
                    <div class="modal-header p-0 border-0">
                        <h5 class="modal-title" id="exampleModalLabel">Добавить тип</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        ...
                    </div>
                    <div class="modal-footer p-0">
                        <button data-dismiss="modal"
                                class="button p-3 px-4 rounded-pill shadow-sm white">
                            Отмена
                        </button>
                        <button
                            class="ml-3 button p-3 px-4 rounded-pill shadow-sm tonight green">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                router: this.$router,
                types: null,
            }
        },
        mounted() {
            let self = this;
            header.loading = true;
            axios.get('/api/v1/issues/types')
                .then(function (response) {
                    header.loading = false;
                    self.types = response.data;
                });
        },
        methods: {
            getDescription: function (text) {
                let size = 25;
                if (text.length > size) {
                    return text.slice(0, size) + ' ...';
                }
                return text;
            },
        },
        components: {}
    }
</script>

<style scoped>
    .description {
        color: #a7a7a7;
    }
</style>
