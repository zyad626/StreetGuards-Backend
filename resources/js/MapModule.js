import MarkerCluster from '@google/markerclusterer';
import $ from 'jquery';
import MapStyle from './MapStyle';
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
        var lat = $('#map').data('lat');
        var lng = $('#map').data('lng');
        var zoomLevel = $('#map').data('zoom');
        this.center = {lat: lat, lng: lng};
        this.map = new google.maps.Map(
            document.getElementById('map'), {
                zoom: zoomLevel,
                center: this.center,
                disableDefaultUI: true,
                styles: MapStyle
            }
        );

        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);
        this.map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

        let markers = [];
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();
        
            if (places.length == 0) {
              return;
            }
            // Clear out the old markers.
            markers.forEach(marker => {
              marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            const bounds = new google.maps.LatLngBounds();
            places.forEach(place => {
              if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
              }
              const icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
              };
              let map =this.map;
              // Create a marker for each place.
              markers.push(
                new google.maps.Marker({
                  map,
                  icon,
                  title: place.name,
                  position: place.geometry.location
                })
              );
        
              if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
              } else {
                bounds.extend(place.geometry.location);
              }
            });
            this.map.fitBounds(bounds);
        });
        
        this.cluster = new MarkerCluster(this.map);
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                var currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                this.map.panTo(currentLocation);
                setTimeout(_ => {
                    this.map.setZoom(12);
                }, 100);
                var marker = new google.maps.Marker({
                    position: currentLocation,
                    map: this.map,
                    icon: "images/current_location.png"
                });
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