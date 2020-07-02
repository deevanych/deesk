<template>
    <textarea :name="name" id="summernote" cols="30" rows="10" v-bind:value="value"
              v-bind:required="required"></textarea>
</template>

<script>

    export default {
        name: 'summernote',
        props: ['name', 'required', 'placeholder', 'onEnter', 'value'],
        mounted() {
            let self = this;
            $('#summernote').summernote({
                placeholder: self.placeholder,
                height: 120,
                toolbar: [
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'picture', 'video']],
                ],
                disableResizeEditor: true,
                callbacks: {
                    onEnter: function () {
                        if (self.onEnter !== undefined) {
                            self.onEnter();
                        }
                    },
                    onChange: function (contents) {
                        // self.$emit('input', contents.replace(/<\/?[^>]+(>|$)/g, ""));
                        let cleanContent = contents.replace(/<\/?[^>]+(>|$)/g, "");
                        if (cleanContent === '') {
                            contents = cleanContent;
                        }
                        self.$emit('input', contents);
                    }
                },
            });
        },
    }
</script>

<style scoped>
    #image {
        position: fixed;
    }
</style>
