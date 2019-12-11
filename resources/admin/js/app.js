
try {
    window.$ = window.jQuery = require('jquery');
    require('../semantic/dist/semantic.min.js');
    require('air-datepicker');
    require('air-datepicker/dist/js/i18n/datepicker.en.js')
    require('air-datepicker/dist/css/datepicker.css');
} catch (e) {}


$(function () {
    $('.ui.checkbox').checkbox();
    $('.ui.dropdown').dropdown();

    $('.Datepicker').datepicker({
        language: 'en',
        dateFormat: 'MM dd, yyyy',
        autoClose: true
    });

});