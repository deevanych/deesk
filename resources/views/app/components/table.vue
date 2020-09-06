<template>
    <div>
        <div class="row">
            <div class="col-3 d-flex align-items-center">
                <span class="flex-shrink-0 mr-3">Показывать по:</span>
                <select2
                    v-model="pageCount"
                    v-bind="{values: pageMenu, name: 'page_count', nullable: false, nullTitle: 'Любой'}"
                    v-on:input="changePageLength"></select2>
            </div>
            <div v-if="searchField" class="col-5 ml-auto text-right">
                <input type="text" v-model="q" placeholder="поиск .." @keyup="search(q)"
                       class="p-2 px-4 rounded-pill shadow-sm button" name="search[value]">
            </div>
        </div>
        <table class="table dataTable" ref="table">
            <thead>
            <tr>
                <th v-for="column in columns">
                    {{ column.title }}
                </th>
            </tr>
            </thead>
            <template v-if="!data">
                <tr v-for="n in 4">
                    <td v-for="column in columns">
                        <PuSkeleton width="100%" height="1rem"></PuSkeleton>
                    </td>
                </tr>
            </template>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        columns: {
            type: Array,
            required: true
        },
        url: {
            type: String,
            required: true
        },
        searchField: {
            type: Boolean,
            default: true
        },
        pageMenu: {
            type: Array,
            default: function () {
                return [
                    {'id': 10, 'title': 10},
                    {'id': 20, 'title': 20},
                    {'id': 50, 'title': 50},
                    {'id': 100, 'title': 100}
                ]
            }
        },
    },
    data: function () {
        return {
            pageCount: 10,
            q: null,
            table: null,
            elementsCount: 0,
            searchTimer: null,
            data: null,
        }
    },
    mounted() {
        let self = this;
        self.table = $(this.$refs.table).DataTable({
            searching: false,
            bLengthChange: false,
            processing: false,
            language: {
                processing: "Загрузка ..",
                search: "поиск ..",
                lengthMenu: "Показывать по _MENU_ элементов",
                info: "Показано с _START_ по _END_ элементов. Всего _TOTAL_ элементов.",
                infoEmpty: "Не найдено совпадений.",
                infoFiltered: "(вне фильтра _MAX_ элементов)",
                infoPostFix: "",
                loadingRecords: "Chargement en cours...",
                zeroRecords: "Элементов нет",
                emptyTable: "Элементов нет",
                paginate: {
                    first: "Первая",
                    previous: "Предыдущая",
                    next: "Следующая",
                    last: "Последняя"
                },
                aria: {
                    sortAscending: ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            },
            "serverSide": true,
            "lengthMenu": self.pageMenu.map(item => item.id),
            "ajax": {
                "url": self.url,
                "data": function (d) {
                    d.search['value'] = self.q;
                },
                "beforeSend": function (request) {
                    request.setRequestHeader("Authorization", localStorage.getItem('_token'));
                },
            },
            "columns": self.columns
        }).on('draw', function () {
            header.loading = false;
            $(self.$refs.table).find('tbody').show();
            self.data = {};
        }).on('preXhr', function () {
            header.loading = true;
            $(self.$refs.table).find('tbody').hide();
            self.data = null;
        }).on('xhr', function (e, settings, data) {
            self.elementsCount = data.recordsTotal;
        });
    },
    watch: {
      url: function() {
          this.changeData();
      }
    },
    methods: {
        search(q) {
            let self = this;
            clearTimeout(self.searchTimer);
            self.searchTimer = setTimeout(function () {
                self.table.search(q).draw();
            }, 1000);
        },
        changePageLength() {
            let self = this;
            self.table.page.len(self.pageCount).draw();
        },
        changeData() {
            let self = this;
            self.table.ajax.url(self.url);
            self.table.ajax.reload();
        },
    }
}

</script>

<style lang="scss">
.dataTables_wrapper {
    tr {
        width: 100%;

        td:nth-child(1), th:nth-child(1) {
            width: 4rem !important;
        }
    }

    .row:nth-of-type(3) {
        align-items: center;

        .col-sm-12.col-md-7 {
            display: flex;

            .dataTables_paginate {
                margin-left: auto;
            }
        }
    }

    .pagination {
        margin-bottom: 0;

        li {
            margin: 0 .2rem;

            &.disabled {
                a {
                    opacity: .6;
                }
            }

            &.previous, &.next {
                a {
                    background-image: url('/images/icons/dropdown-left.svg');
                    background-repeat: no-repeat;
                    background-position: center;
                    text-indent: 999999px;
                    overflow: hidden;
                    background-size: 8px;
                }
            }

            &.next {
                a {
                    background-image: url('/images/icons/dropdown-right.svg');
                }
            }

            a {
                border-radius: 50% !important;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
                display: inline-block;
                width: 32px;
                height: 32px;
                line-height: 28px;
                padding: 0;
                text-align: center;
                border: 2px solid #fff;
                box-sizing: border-box;
                transition: .3s;

                &:hover {
                    box-shadow: 0.12rem 0.25rem 0.25rem rgba(0, 0, 0, 0.4) !important;
                    border-color: #007bff;
                    background: #fff;
                    color: #007bff;
                }
            }
        }
    }
}
</style>
