import jquery from 'jquery';

window.$ = window.jQuery = jquery;

$(document).ready(function () {
    $(document).on('click','.comment img',  function () {
        console.log(2);
        let image = $(this),
            src = image.attr('src');
        $('#image img').attr('src', src);
    });
});
