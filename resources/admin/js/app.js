import MapModule from './MapModule';
import CrashMapperClient from './CrashMapperClient';
import Vue from 'vue';

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

if ($('#map').length > 0) {

    let map = new MapModule();
    let crashMapperClient = new CrashMapperClient();
    
    var isLoading = {};
    var loadIncidents = function (type, newVal) {
        if (newVal) {
            if (!isLoading[type]) {
                isLoading[type] = true;
                crashMapperClient.get('incidents', {'type': type})
                    .then(data => {
                        isLoading[type] = false;
    
                        if (mapFilter.filter[type]) {
                            map.addGroup(type, data);
                        }
                    });
            }
        } else {
            map.removeGroup(type);
        }
    };
        
    var mapFilter = new Vue({
        el: '#map_filter',
        data: {
            filter: {
                'crash_near_miss': true,
                'hazard': true,
                'threatening': true,
            }
        },
        mounted: function () {
            loadIncidents('crash_near_miss', true);
            loadIncidents('hazard', true);
            loadIncidents('threatening', true);
        }
    });
    
    mapFilter.$watch('filter.crash_near_miss', function (newVal, oldVal) {
        loadIncidents('crash_near_miss', newVal);
    });
    
    mapFilter.$watch('filter.hazard', function (newVal, oldVal) {
        loadIncidents('hazard', newVal);
    });
    
    mapFilter.$watch('filter.threatening', function (newVal, oldVal) {
        loadIncidents('threatening', newVal);
    });
    
}
