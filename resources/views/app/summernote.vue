<template>
    <div v-if="comments">
        <div class="row mt-5">
            <div class="col">
                <form @submit.prevent="submitComment" id="submit-comment">
                    <textarea :name="name" id="summernote" cols="30" rows="10" v-model="content"></textarea>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="offset-8 col">
                <button type="submit" :disabled="disable" form="submit-comment"
                        class="button ml-auto p-3 px-4 rounded-pill shadow-sm blue text-center d-block">Отправить
                </button>
            </div>
        </div>
        <div id="image"><img width="500"/></div>
    </div>
    <div v-else>
        <div class="d-flex row mt-5">
            <div class="col">
                <PuSkeleton width="100%" height="200px"></PuSkeleton>
            </div>
        </div>
        <div class="row mt-3">
            <div class="offset-8 col">
                <PuSkeleton width="100%" height="56px"></PuSkeleton>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'summernote',
        props: ['name', 'content', 'comments'],
        data() {
            return {
                disable: false,
            }
        },
        updated() {
            let app = this;
            $('#summernote').summernote({
                placeholder: 'Введите сообщение ..',
                height: 120,
                toolbar: [
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'picture', 'video']],
                ],
                disableResizeEditor: true,
                callbacks: {
                    onEnter: function() {
                        app.submitComment();
                    }
                },
            });
        },
        methods: {
            submitComment() {
                this.disable = true;
                header.loading = true;
                let textInput = $('#submit-comment').find('[name=text]'),
                    app = this;
                axios.post('/api/v1/issues/' + this.$route.params.id + '/comments', {
                    text: textInput.val(),
                })
                    .then(function (response) {
                        header.loading = false;
                        app.disable = false;
                        toastr[response.data.status](response.data.message);
                        if (response.data.published) {
                            $('#summernote').summernote('reset');
                            app.comments.push(response.data.comment);
                        }
                    })
                    .catch(function () {
                        header.loading = false;
                        app.disable = false;
                        toastr['error']('Произошла ошибка');
                    });
            }
        }
    }
</script>

<style scoped>
    #image {
        position: fixed;
    }
</style>
