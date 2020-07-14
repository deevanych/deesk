<template>
    <div id="scroll-top" @click="scrollToTop"></div>
</template>

<script>
    export default {
        mounted() {
            let self = this;
            self.toggleScrollTop();
        },
        methods: {
            toggleScrollTop() {
                $(window).on('scroll', function () {
                    if ($(window).scrollTop() > 300) {
                        $('#scroll-top').addClass('show');
                    } else {
                        $('#scroll-top').removeClass('show');
                    }
                });
            },
            scrollToTop() {
                $('html, body').animate({'scrollTop': 0}, 300);
            }
        }
    }
</script>

<style scoped>
    #scroll-top {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        width: 50px;
        cursor: pointer;
        transition: .3s;
        background-color: rgba(137, 105, 193, .2);
        background-image: url(/images/icons/dropdown-up.svg);
        background-repeat: no-repeat;
        background-position: center;
        background-size: 1rem;
        display: none;
        opacity: .3;
    }

    #scroll-top.show {
        display: block;
    }

    #scroll-top.show:hover {
        display: block;
        opacity: 1;
    }
</style>
