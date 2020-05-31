<template>
    <select v-bind:multiple="multiple" class="select2" v-model="value" v-bind:name="name" ref="select2" data-po="ewew">
        <option v-if="nullable" v-bind:value="null">{{ nullTitle }}</option>
        <option v-for="(value, key) in values" v-bind:value="value.id">{{ value.title}}</option>
    </select>
</template>

<script>
    export default {
        props: ['value', 'name', 'values', 'nullable', 'nullTitle', 'multiple'],
        data: function () {
            return {
                // value: '',
            }
        },
        methods: {},
        mounted() {
            let self = this;
            $(self.$refs.select2).select2().on('change', function (e) {
                let val = ($(e.target).val()) ? $(e.target).val() : null;
                self.$emit('input', val);
            });
        },
        updated() {
            let self = this;
            $(self.$refs.select2).select2().trigger('update');
        }
    }
</script>
