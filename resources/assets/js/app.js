/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$("img.svg").each(function () {
    // Perf tip: Cache the image as jQuery object so that we don't use the selector muliple times.
    var $img = jQuery(this);
    // Get all the attributes.
    var attributes = $img.prop("attributes");
    // Get the image's URL.
    var imgURL = $img.attr("src");
    // Fire an AJAX GET request to the URL.
    $.get(imgURL, function (data) {
        // The data you get includes the document type definition, which we don't need.
        // We are only interested in the <svg> tag inside that.
        var $svg = $(data).find('svg');
        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr('xmlns:a');
        // Loop through original image's attributes and apply on SVG
        $.each(attributes, function () {
            $svg.attr(this.name, this.value);
        });
        // Replace image with new SVG
        $img.replaceWith($svg);
    });
});

$('#logout img').on('click', function () {
    
    $(this).closest('form').submit();
});


/* 
import 'summernote/dist/summernote-bs4';
import 'summernote/dist/summernote-bs4.css';
window.toastr = require('toastr');
import 'toastr/build/toastr.min.css';
window.Swal = require('sweetalert');
window.Mustache = require('mustache');
window.autosize = require('autosize');
var ta = document.querySelector('textarea');
if (ta) {
    ta.addEventListener('focus', function () {
        autosize(ta);
    });
}
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
} */