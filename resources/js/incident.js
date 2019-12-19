class Incident {
    constructor() {
        this.date = null;
        this.type = null;
        this.location = { lat: null, lng: null };

        this.crash_data = {};
        this.hazard_data = {};
        this.threatening_data = {};

        this.description = null;

        this.files = [];
    }
}

export { Incident as default }
