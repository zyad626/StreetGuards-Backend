@extends('site.layouts.basic')

@section('title', __('Home'))

@section('content')
<div class='Map-Module' id='map'></div>

<div class='Map-Filter'>
    <div class="form-group">
        <label class="form-checkbox">
            <input type="checkbox">
            <i class="form-icon"></i> Accidents
        </label>
    </div>
    <div class="form-group">
        <label class="form-checkbox">
            <input type="checkbox">
            <i class="form-icon"></i> Hazards
        </label>
    </div>
    <div class="form-group">
        <label class="form-checkbox">
            <input type="checkbox">
            <i class="form-icon"></i> Threatening Harrasment
        </label>
    </div>
    <button id='app-add-incident' class='btn btn-primary' data-micromodal-trigger="modal-1">Add</button>

</div>

<div class="modal" id="add-incident-modal">
    <div class="modal-overlay" aria-label="Close"></div>
    <div class="modal-container">
        <div class="modal-header">
            <span class="btn btn-clear float-right app-close" aria-label="Close"></span>
            <div class="modal-title h5">Report Incident</div>
            <div class="divider"></div>
        </div>
        <div class="modal-body">
            
            <div class="content">
                
                <form class='app-incident-form' @submit="checkForm">
                    <!-- content here -->
                    <input type="hidden" name='lat' v-model='incident.location.lat'>
                    <input type="hidden" name='lng' v-model='incident.location.lng'>

                    <div class='form-group'>
                        <label class="form-label text-bold">Date</label>
                        <input class="form-input app-date" type="text" v-model='incident.date'>
                    </div>
                    <!-- form input control -->
                    <div class="form-group">
                        <label class="form-label text-bold">Choose Type</label>
                        <label class="form-radio form-inline">
                            <input type="radio" name="type" value='accident' v-model='incident.type'>
                            <i class="form-icon"></i> Accident
                        </label>
                        <label class="form-radio form-inline">
                            <input type="radio" name="type" value='threatening' v-model='incident.type'>
                            <i class="form-icon"></i> Threatening Incident
                        </label>
                        <label class="form-radio form-inline">
                            <input type="radio" name="type" value='hazard' v-model='incident.type'>
                            <i class="form-icon"></i> Hazard
                        </label>
                    </div>
                    <div class='app-accident-data'  v-if="incident.type == 'threatening'">
                        <div class='form-group'>
                            <label class="form-label text-bold">Type</label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='vandalism' v-model='incident.threatening_type'>
                                <i class="form-icon"></i> Vandalism
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='harassment' v-model='incident.threatening_type'>
                                <i class="form-icon"></i> Harassment
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='insecurity' v-model='incident.threatening_type'>
                                <i class="form-icon"></i> Insecurity
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='other' v-model='incident.threatening_type'>
                                <i class="form-icon"></i> other
                            </label>
                        </div>
                    </div>
                    <div class='app-accident-data'  v-if="incident.type == 'accident'">
                        <div class='form-group'>
                            <label class="form-label text-bold">Number of involved</label>
                            <label class='form-label form-inline'>
                                Bikes
                                <input class="form-input" type="number" v-model='incident.number_of_bikes'>
                            </label>
                            <label class='form-label form-inline'>
                                Vehicles
                                <input class="form-input" type="number" v-model='incident.number_of_vehicles'>
                            </label>
                            <label class='form-label form-inline'>
                                Pedesterians
                                <input class="form-input" type="number" v-model='incident.number_of_pedesterians'>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-label text-bold">Are you involved in the accident?</label>
                            <label class="form-radio form-inline">
                                <input type="radio" v-model='incident.reporter_involved' v-bind:value="true">
                                <i class="form-icon"></i> Yes
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" name="incident.reporter_involved" v-bind:value="false">
                                <i class="form-icon"></i> No
                            </label>
                        </div>

                        <div class='form-group'>
                            <label class="form-label text-bold">Purpose of trip</label>

                            <label class="form-radio form-inline">
                                <input type="radio" value='work' v-model="incident.purpose_of_trip">
                                <i class="form-icon"></i> Work
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='social_trip' v-model="incident.purpose_of_trip">
                                <i class="form-icon"></i> Social trip
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='personal_business' v-model="incident.purpose_of_trip">
                                <i class="form-icon"></i> Personal business
                            </label>
                        </div>

                        <div class='form-group'>
                            <label class="form-label text-bold">Collision</label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='intersection' v-model="incident.collision_at">
                                <i class="form-icon"></i> Intersection
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='roadway' v-model="incident.collision_at">
                                <i class="form-icon"></i> Roadway
                            </label>
                        </div>

                        <div class='form-group'>
                            <label class="form-label text-bold">Type of collision</label>
                            <input class="form-input" type="text" v-model='incident.type_of_collision'>
                        </div>

                        <div class='form-group'>
                            <label class="form-label text-bold">Number of injuries</label>
                            <input class="form-input" type="text" v-model='incident.number_of_injuries'>
                        </div>

                        <div class='form-group'>
                            <label class="form-label text-bold">Number of fatalities</label>
                            <input class="form-input" type="text" v-model='incident.number_of_fatalities'>
                        </div>
                    </div>

                    <div class='app-hazard-data'  v-if="incident.type == 'hazard'">
                        <div class='form-group'>
                            <label class='form-label text-bold'>Type of object</label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='stationary_object' v-model="incident.type_of_collider">
                                <i class="form-icon"></i> Stationary object
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='another_vehicle' v-model="incident.type_of_collider">
                                <i class="form-icon"></i> Another vehicle
                            </label>
                        </div>
                    </div>

                    <div v-if="incident.type == 'accident' || incident.type == 'hazard'">
                        <div class='form-group' >
                            <label class="form-label text-bold">Type of road</label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='asphalt' v-model="incident.road_type"><i class="form-icon"></i> Asphalt
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='gravel' v-model="incident.road_type"><i class="form-icon"></i> Gravel
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='concrete' v-model="incident.road_type"><i class="form-icon"></i> Concrete
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='other' v-model="incident.road_type"><i class="form-icon"></i> other
                            </label>
                        </div>
    
    
                        <div class='form-group'>
                            <label class="form-label text-bold">Roadway surface condition</label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='dry' v-model="incident.road_surface_condition"><i class="form-icon"></i> Dry
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='muddy' v-model="incident.road_surface_condition"><i class="form-icon"></i> Muddy
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='wet' v-model="incident.road_surface_condition"><i class="form-icon"></i> Wet
                            </label>
                        </div>
    
                        <div class='form-group'>
                            <label class="form-label text-bold">Weather</label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='sunny' v-model="incident.road_surface_condition"><i class="form-icon"></i> Sunny
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='cloudy' v-model="incident.road_surface_condition"><i class="form-icon"></i> Cloudy
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='rainy' v-model="incident.road_surface_condition"><i class="form-icon"></i> Rainy
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='sand_storm' v-model="incident.road_surface_condition"><i class="form-icon"></i> Sand Storm
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='foggy' v-model="incident.road_surface_condition"><i class="form-icon"></i> Foggy
                            </label>
                        </div>
                    </div>
                    
                    <div v-if="incident.type">

                        <div class='form-group'>
                            <label class="form-label text-bold">Tell us more about what happened</label>
                            <textarea v-model="incident.description" class="form-input" cols="30" rows="3"></textarea>
                        </div>
    
                        <div class='form-group text-bold'>
                            <label class="form-label">Upload photos or videos</label>
    
                        </div>
                    </div>

                    

                    <div class="toast toast-error" v-if='errors.length > 0'>
                        <ul>
                            <li v-for="error in errors">
                                @{{ error }}
                            </li>
                        </ul>
                    </div>
                    <div class="pt-2 float-right">

                        <button class="btn btn-primary" v-on:click="save" :disabled='valid == false'>Submit</button>
                    </div>

                </form>
            </div>
        </div>
        
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgUrAcFPriGCar9g7_3lwYLGOHpjN59rY"
    type="text/javascript"></script>
@endsection