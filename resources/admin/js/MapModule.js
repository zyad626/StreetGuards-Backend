import MarkerCluster from '@google/markerclusterer';
import MapStyle from '../../js/MapStyle';

class MapModule
{
    constructor() {
        this.center;
        this.map;
        this.cluster;
        this.markers = {};
        this.infowindow;
        this.initialize();
    }

    initialize() {
        this.center = {lat: 30.051736, lng: 31.234426};
        this.map = new google.maps.Map(
            document.getElementById('map'), {
                zoom: 2,
                center: this.center,
                disableDefaultUI: true,
                styles: MapStyle
            }
        );

        this.cluster = new MarkerCluster(this.map);
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                var currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                this.map.setCenter(currentLocation);
                var marker = new google.maps.Marker({position: currentLocation, map: this.map});
            });
        }
    }

    addToGroup(type, incident) {
        if (this.markers[type]) {
            var marker = this.createIncidentMarker(incident);
            this.markers[type].push(marker);
            this.cluster.addMarkers([marker]);
        }
    }

    addGroup(groupName, incidents) {
        let markers = [];
        for (let i=0; i<incidents.length; i++) {
            let incident = incidents[i];
            markers.push(
                this.createIncidentMarker(incident)
            );
        }
        this.markers[groupName] = markers;
        this.cluster.addMarkers(markers);
    }

    createIncidentMarker(incident) {
        let incidentLocation = incident.location;
        let location = new google.maps.LatLng(incidentLocation.lat, incidentLocation.lng);

        var iconImage = null;
        if (incident.type == 'crash_near_miss') {
            iconImage = "/images/accident_icon.png";
        } else if (incident.type == 'hazard') {
            iconImage = "/images/hazard_icon.png";
        } else if (incident.type == 'threatening') {
            iconImage = "/images/threatening_icon.png";
        }

        let marker = new google.maps.Marker({
            position: location,
            icon: iconImage
        });
        var contentString = "";

        if (incident.type == 'crash_near_miss') {
            if (incident.crash_data ) {
                var crashData = incident.crash_data;
                if (crashData.type) {
                    contentString += "<b>Type:</b> "+crashData.type+"<br/>";
                }

                if (crashData.number_involved_bikes) {
                    contentString += "<b>Number of bikes:</b> "+crashData.number_involved_bikes+"<br/>";
                }

                if (crashData.number_involved_vehicles) {
                    contentString += "<b>Number of vehicles:</b> "+crashData.number_involved_vehicles+"<br/>";
                }
                if (crashData.number_involved_pedesterians) {
                    contentString += "<b>Number of pedesterians:</b> "+crashData.number_involved_pedesterians+"<br/>";
                }

                if (crashData.number_of_injuries) {
                    contentString += "<b>Number of injuries:</b> "+crashData.number_of_injuries+"<br/>";
                }

                if (crashData.number_of_fatalities) {
                    contentString += "<b>Number of fatalities:</b> "+crashData.number_of_fatalities+"<br/>";
                }
            } else {
                contentString += "<b>Type:</b> Crash / Near Miss<br/>";
            }
        } else if (incident.type == 'hazard') {
            contentString += "<b>Type:</b> Hazard<br/>";
        } else if (incident.type == 'threatening') {
            contentString += "<b>Type:</b> Threatening Incident<br/>";
        }

        contentString += "<b>Date:</b> "+incident.date+"<br/>";


        if (incident.description) {
            contentString += "<b>Description:</b> "+incident.description+"<br/>";
        }

        if (incident.files && incident.files.length > 0) {
            contentString += "<b>files attached:</b> "+incident.files.length+"<br/>";
        }
        contentString += '<a href="/admin/incidents/view/'+incident._id+'" target="_blank">view more</a> <br/>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        marker.addListener('click', () => {
            if (this.infowindow) {
                this.infowindow.close();
            }
            infowindow.open(map, marker);
            this.infowindow = infowindow;
        });

        return marker;
    }

    removeGroup(groupName) {
        this.cluster.removeMarkers(this.markers[groupName]);
        this.markers[groupName] = [];
    }

    chooseLocation() {
        var marker = new google.maps.Marker({
            position: this.center, map: this.map,
            icon: "images/default_icon.png"
        });

        var l1 = this.map.addListener('mousemove', (e) => {
            marker.setPosition(e.latLng); // set marker position to map center
        });

        var l3 = this.map.addListener('right_click', (e) => {
            marker.setMap(null); // remove marker
        });

        return new Promise((resolve, reject) => {

            var l2 = this.map.addListener('click', e => {
                google.maps.event.removeListener(l1);
                google.maps.event.removeListener(l2);
                
                marker.setMap(null);
                resolve({lat: e.latLng.lat, lng: e.latLng.lng});
            });
            
            // this.map.addListener('click', e => {    

            //     marker.setPosition(e.latLng);
            //     // resolve({lat: e.latLng.lat, lng: e.latLng.lng});
            // });
            
        });
    }
}

export { MapModule as default}