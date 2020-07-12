<script>
    export default {
        data: function () {
            return {
                issue: null,
            }
        },
        methods: {
            $can(permission) {
                permission = permission.split('.');
                let permissions = this.$user.permissions;
                if (!permissions[permission[0]]) {
                    return false;
                }
                return (permissions[permission[0]][permission[1]] ? permissions[permission[0]][permission[1]] : false);
            },
            $isOwner(type) {
                switch (type) {
                    case 'user':
                        return this.$user.id == this.$route.params.id;
                        break;
                }
            },
            $type(type) {
                if (this.$user.organization.parent_id && type === 'client') {
                    return true;
                }
                if (!this.$user.organization.parent_id && type === 'service') {
                    return true;
                }
                return false;
            },
            getFormattedTime(time, format = 'DD.MM.YYYY / HH:mm') {
                return moment(time).format(format);
            },
        },
    };
</script>
