<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <h3 class="font-weight-bold d-inline-block mb-0">{{ title }}</h3>
                    <a href="/"
                       class="button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active"
                       data-toggle="modal" data-target="#addIssueStatus">
                        Добавить организацию
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col block-content">
                    <data-table :columns="columns"
                                url="/api/v1/organizations">
                    </data-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: 'Организации'
        }
    },
    data: function () {
        return {
            columns: [
                {
                    'title': '#',
                    'data': 'id',
                    'render': function (data) {
                        return '<span class="d-block text-center">' + data + '</span>';
                    }
                },
                {
                    'title': 'Название',
                    'data': 'title',
                    'render': function (data, type, organization) {
                        return '<a href="' + router.resolve({
                            name: 'organizations.show',
                            params: {id: organization.id}
                        }).href + '" onclick="router.push(\'' + router.resolve({
                            name: 'organizations.show',
                            params: {id: organization.id}
                        }).href + '\'); return false;">' + organization.title + '</a>';
                    }
                },
                {
                    'title': 'Полное наименование',
                    'data': 'full_name',
                    'render': function (data) {
                        return data;
                    }
                }
            ]
        }
    }
}
</script>
