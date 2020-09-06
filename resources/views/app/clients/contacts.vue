<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col align-items-center d-flex justify-content-between">
                    <h3 class="font-weight-bold d-inline-block mb-0">Контакты</h3>
                    <a href="/"
                       class="button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active"
                       data-toggle="modal" data-target="#addIssueStatus">
                        Добавить контакт
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col block-content">
                    <data-table :columns="columns"
                                url="/api/v1/users?type=clients">
                    </data-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
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
                    'title': 'ФИО',
                    'data': 'title',
                    'render': function (data, type, user) {
                        return '<a href="' + router.resolve({
                            name: 'users.show',
                            params: {id: user.id}
                        }).href + '" onclick="router.push(\'' + router.resolve({
                            name: 'users.show',
                            params: {id: user.id}
                        }).href + '\'); return false;">' + user.title + '</a>';
                    }
                },
                {
                    'title': 'Организация',
                    'data': 'organization.title',
                    'render': function (data, type, user) {
                        return '<a href="' + router.resolve({
                            name: 'organizations.show',
                            params: {id: user.organization.id}
                        }).href + '" onclick="router.push(\'' + router.resolve({
                            name: 'organizations.show',
                            params: {id: user.organization.id}
                        }).href + '\'); return false;">' + user.organization.title + '</a>';
                    },
                    'sortable': false
                }
            ]
        }
    }
}
</script>
