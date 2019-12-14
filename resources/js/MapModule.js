import MarkerCluster from '@google/markerclusterer';

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
            document.getElementById('map'), {zoom: 16, center: this.center}
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
        if (incident.type == 'accident') {
            iconImage = "images/accident_icon.png";
        } else if (incident.type == 'hazard') {
            iconImage = "images/hazard_icon.png";
        } else if (incident.type == 'threatening') {
            iconImage = "images/threatening_icon.png";
        }

        let marker = new google.maps.Marker({
            position: location,
            icon: iconImage
        });
        var contentString = "";

        if (incident.type == 'accident') {
            contentString += "<b>Type:</b> Accident<br/>";
        } else if (incident.type == 'hazard') {
            contentString += "<b>Type:</b> Hazard<br/>";
        } else if (incident.type == 'threatening') {
            contentString += "<b>Type:</b> Threatening Incident<br/>";
        }

        contentString += "<b>Date:</b> "+incident.date+"<br/>";


        if (incident.number_of_bikes) {
            contentString += "<b>Number of bikes:</b> "+incident.number_of_bikes+"<br/>";
        }

        if (incident.number_of_vehicles) {
            contentString += "<b>Number of vehicles:</b> "+incident.number_of_vehicles+"<br/>";
        }
        if (incident.number_of_pedesterians) {
            contentString += "<b>Number of pedesterians:</b> "+incident.number_of_pedesterians+"<br/>";
        }

        if (incident.number_of_injuries) {
            contentString += "<b>Number of injuries:</b> "+incident.number_of_injuries+"<br/>";
        }

        if (incident.number_of_fatalities) {
            contentString += "<b>Number of fatalities:</b> "+incident.number_of_fatalities+"<br/>";
        }

        if (incident.description) {
            contentString += "<b>Description:</b> "+incident.description+"<br/>";
        }

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
        var marker = new google.maps.Marker({position: this.center, map: this.map});

        var l1 = this.map.addListener('mousemove', (e) => {
            marker.setPosition(e.latLng); // set marker position to map center
        });

        return new Promise((resolve, reject) => {

            var l2 = this.map.addListener('click', e => {
                google.maps.event.removeListener(l1);
                google.maps.event.removeListener(l2);

                marker.setPosition(e.latLng);
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