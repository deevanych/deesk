import jquery from 'jquery';

window.$ = window.jQuery = jquery;

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
