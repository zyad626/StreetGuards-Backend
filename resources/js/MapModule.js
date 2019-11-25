import MarkerCluster from '@google/markerclusterer';

class MapModule
{
    constructor() {
        this.center;
        this.map;
        this.cluster;
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
            let incidentLocation = incident.location;
            let location = new google.maps.LatLng(incidentLocation.lat, incidentLocation.lng);

            let marker = new google.maps.Marker({position: location});
            markers.push(marker);
        }
        this.cluster.addMarkers(markers);

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