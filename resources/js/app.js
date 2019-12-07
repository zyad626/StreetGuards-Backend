import MapModule from './MapModule';
import CrashMapperClient from './CrashMapperClient';
import $ from 'jquery';
import Vue from 'vue';
import Incident from './incident';

window.jQuery = $;
require('./bootstrap');

require('air-datepicker/dist/js/datepicker');
require('air-datepicker/dist/js/i18n/datepicker.en');

let map = new MapModule();
let crashMapperClient = new CrashMapperClient();
crashMapperClient.get('incidents')
    .then(data => {
        map.addGroup('incidens', data.data);
    });

var form = new Vue({
        el: '#add-incident-modal',
        data: {
            incident: new Incident(),
            errors: []
        },
        methods: {
            save: function (event) {
                crashMapperClient.post('incidents', this.incident)
                .then(_ => {
                    $('#add-incident-modal').removeClass('active');
                }).catch(e => {
                    if (e.response) {
                        console.log(e.response.data);
                        this.errors = e.response.data.errors;
                    }
                });
            },
            checkForm: function (e) {
                e.preventDefault();
            }
        },
        computed: {
            valid: function () {
                // must parse because Vue turns empty value to string
                return true;
            }
        },
        mounted: function () {
            $('#add-incident-modal .app-date').datepicker({
                language: 'en',
                dateFormat: 'yyyy-mm-dd',
                autoClose : true,
                onSelect: (formattedDate, date, inst) => {
                    this.incident.date = formattedDate;
                }
            }).data('datepicker');
        }
    });


$('#app-add-incident').on('click', e => {
    map.chooseLocation()
        .then(location => {
            form.incident = new Incident;
            form.errors = [];
            $('#add-incident-modal').addClass('active');
            var myDatepicker = $('#add-incident-modal .app-date').datepicker().data('datepicker');
            myDatepicker.selectDate(new Date());
            form.incident.location= {
                lat: location.lat(),
                lng: location.lng(),
            };
        });
});

$('.app-close').click(_ => {
    $('#add-incident-modal').removeClass('active');
})
