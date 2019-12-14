import MapModule from './MapModule';
import CrashMapperClient from './CrashMapperClient';
import $ from 'jquery';
import Vue from 'vue';
import Incident from './incident';
import Dropzone from 'dropzone';

window.jQuery = $;
require('./bootstrap');

require('air-datepicker/dist/js/datepicker');
require('air-datepicker/dist/js/i18n/datepicker.en');

let map = new MapModule();
let crashMapperClient = new CrashMapperClient();
Dropzone.autoDiscover = false;
var myDropZone;


var form = new Vue({
        el: '#add-incident-modal',
        data: {
            incident: new Incident(),
            errors: []
        },
        methods: {
            save: function (event) {
                crashMapperClient.post('incidents', this.incident)
                .then(incident => {
                    $('#add-incident-modal').removeClass('active');
                    map.addToGroup(incident.type, incident);
                    myDropZone.removeAllFiles(true);
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
            var $date = $('#add-incident-modal .app-date');
            $('#add-incident-modal .app-date').datepicker({
                language: 'en',
                dateFormat: 'yyyy-mm-dd',
                autoClose : true,
                onSelect: (formattedDate, date, inst) => {
                    this.incident.date = formattedDate;
                }
            }).data('datepicker');
            myDropZone = new Dropzone("div#files-uploader", { url: "/api/files"});
            myDropZone.on('success', (file, response) => {
                this.incident.files.push(response.id);
            });
        }
    });

var loadIncidents = function (type, newVal) {
    if (newVal) {
        crashMapperClient.get('incidents', {'type': type})
            .then(data => {
                map.addGroup(type, data.data);
            });
    } else {
        map.removeGroup(type);
    }
};
    
var mapFilter = new Vue({
    el: '#map_filter',
    data: {
        filter: {
            'accidents': true,
            'hazards': true,
            'threatening_incidents': true,
        }
    },
    mounted: function () {
        loadIncidents('accident', true);
        loadIncidents('hazard', true);
        loadIncidents('threatening', true);
    }
});

mapFilter.$watch('filter.accidents', function (newVal, oldVal) {
    debugger;
    loadIncidents('accident', newVal);
});

mapFilter.$watch('filter.hazards', function (newVal, oldVal) {
    loadIncidents('hazard', newVal);
});

mapFilter.$watch('filter.threatening_incidents', function (newVal, oldVal) {
    loadIncidents('threatening', newVal);
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
