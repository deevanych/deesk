<template>
    <div v-if="comments">
        <div class="row mb-4 comments-block shadow-sm p-5">
            <div class="col">
                <h4 class="text-gray mb-4 font-weight-bold">Комментарии <span
                    class="badge count ml-2">{{ comments.length }}</span>
                </h4>
                <perfect class="comments" v-if="comments.length">
                    <div class="comment d-flex align-items-end" v-for="comment in comments"
                         v-bind:class="{ self: comment.self}">
                        <div class="user-avatar flex-shrink-0"
                             style="background-image: url(https://deesk.ru/storage/clients/2.jpg);"></div>
                        <div class="comment-body d-flex flex-column px-4 py-3">
                            <span class="comment-author font-weight-bolder">{{ comment.author.name }}</span>
                            <span class="comment-text" v-html="comment.text"></span>
                        </div>
                        <span class="comment-date flex-shrink-0">{{ comment.created_at }}</span>
                    </div>
                </perfect>
                <div class="comments" v-else>
                    Комментариев нет
                </div>
                <summernote v-bind="{comments: comments, name: 'text'}"></summernote>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="row mb-4 comments-block shadow-sm p-5">
            <div class="col">
                <h4 class="text-gray mb-4 font-weight-bold d-flex align-items-center">
                    <PuSkeleton width="200px" height="28px"></PuSkeleton>
                    <PuSkeleton width="32px" height="32px" class="ml-2"></PuSkeleton>
                </h4>
                <div class="comments">
                    <div class="comment d-flex align-items-end" v-for="n in 3">
                        <PuSkeleton class="user-avatar flex-shrink-0" width="30px" height="30px" circle=""></PuSkeleton>
                        <PuSkeleton width="200px" height="80px"></PuSkeleton>
                        <PuSkeleton width="50px" height="1rem" class="comment-date flex-shrink-0"></PuSkeleton>
                    </div>
                </div>
                <summernote v-bind="{comments: comments, name: 'text'}"></summernote>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'comments',
        props: ['content'],
        data: function () {
            return {
                comments: null,
            }
        },
        updated() {
            $('.comments').scrollTop(9999999999);
        },
        mounted() {
            let self = this;
            axios.get('/api/v1/issues/' + this.$route.params.id + '/comments')
                .then(function (response) {
                    self.comments = response.data;
                });
        },
    }
</script>

<style scoped>
    .comments {
        max-height: 500px;
        overflow: auto;
        padding-right: 20px;
    }

    .comment {
        position: relative;
        margin-bottom: 3rem;
    }

    .comment .user-avatar {
        margin-right: 1rem;
    }

    .comment-body {
        background: #f8f9fa;
        border-radius: 10px 10px 10px 0px;
    }

    .comment-author {
        color: rgba(0, 0, 0, .5);
    }

    .comment .comment-date {
        margin-left: 0.5rem;
        color: rgba(0, 0, 0, .5);
        font-size: 0.7rem;
        position: absolute;
        bottom: -30px;
        left: 40px;
    }

    .comment.self .comment-body {
        background: #56a9ff;
        border-radius: 10px 10px 0px 10px;
    }

    .comment.self .comment-body .comment-text, .comment.self .comment-body .comment-author {
        color: #fff;
        text-align: right;
    }

    .comment.self {
        flex-direction: row-reverse;
    }

    .comment.self .user-avatar {
        width: 30px;
        height: 30px;
        margin-right: 0rem;
        margin-left: 1rem;
    }

    .comment.self .comment-date {
        left: initial;
        margin-right: 0.5rem;
        right: 40px;
    }

    .comments-block {
        border-radius: 50px;
    }
</style>
