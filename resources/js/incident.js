class Incident {
    constructor() {
        this.date = '';
        this.type = '';
        this.location = { lat: null, lng: null }

        //Accident
        this.number_of_vehicles = '';
        this.number_of_bikes = '';
        this.number_of_pedesterians = '';
        this.type_of_collision = '';
        this.number_of_injuries = '';
        this.number_of_fatalities = '';
        this.purpose_of_trip = '';
        this.reporter_involved = '';
        this.collision_at = '';

        //Threatening
        this.threatening_type = '';

        //Hazard
        this.collision_type = '';
        this.type_of_collider = '';

        //general
        this.road_type = '';
        this.road_surface_condition = '';
        this.weather = '';
        this.description = '';
    }
}

export { Incident as default }
