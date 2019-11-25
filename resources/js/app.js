import MapModule from './MapModule';
import CrashMapperClient from './CrashMapperClient';
import $ from 'jquery';


require('./bootstrap');

let map = new MapModule();
let crashMapperClient = new CrashMapperClient();
crashMapperClient.get('incidents')
    .then(data => {
        map.addGroup('incidens', data.data);
    });

$('#app-add-incident').on('click', e => {
    map.chooseLocation()
        .then(location => {
            $('#add-incident-modal').addClass('active');
            $('#add-incident-modal .lat').val(location.lat);
            $('#add-incident-modal .lng').val(location.lng);
        });
});

$('.app-incident-form').submit(function (e) {
    e.preventDefault();
    
    let incident = {
        'location': {
            'lat': $('[name=lat]', $(this)).val(),
            'lng': $('[name=lng]', $(this)).val(),
        },
        'type': 'accident',
        'date': '2019-11-25'
    };
    crashMapperClient.post('incidents', incident)
    .then(_ => {
        $('#add-incident-modal').removeClass('active');
    });
});