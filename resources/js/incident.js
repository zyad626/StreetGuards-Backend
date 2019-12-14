class Incident {
    constructor() {
        this.date = null;
        this.type = null;
        this.location = { lat: null, lng: null }

        //Accident
        this.number_of_vehicles = null;
        this.number_of_bikes = null;
        this.number_of_pedesterians = null;
        this.type_of_collision = null;
        this.number_of_injuries = null;
        this.number_of_fatalities = null;
        this.purpose_of_trip = null;
        this.reporter_involved = null;
        this.collision_at = null;

        //Threatening
        this.threatening_type = null;

        //Hazard
        this.hazard_type = null;

        //general
        this.road_type = null;
        this.road_surface_condition = null;
        this.weather = null;
        this.description = null;
    }
}

export { Incident as default }
