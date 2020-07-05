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
            $type(type) {
                if (this.$user.organization.parent_id && type === 'client') {
                    return true;
                }
                if (!this.$user.organization.parent_id && type === 'service') {
                    return true;
                }
                return false;

            },
        },
    };
</script>
