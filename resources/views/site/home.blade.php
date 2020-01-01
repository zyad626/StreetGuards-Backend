@extends('site.layouts.basic')

@section('title', __('Home'))

@section('content')
<div class='Map-Module' id='map'></div>


<div class='actions'>
    <button id='app-add-incident' class='btn btn-primary' data-micromodal-trigger="modal-1">Report Incident</button>
</div>
<div class='Map-Filter' id='map_filter'>

    <h5>Filter</h5>
    <div class="form-group">
        <label class="form-checkbox">
            <input type="checkbox" v-model='filter.crash_near_miss'>
            <i class="form-icon" ></i>
            <img src="{{ asset('images/accident_n_icon.png') }}" style='height: 20px; display:inline-block;' alt="">
            <span style='user-select: none; '>
                Crash / Near Miss
            </span>
        </label>
    </div>
    <div class="form-group">
        <label class="form-checkbox">
            <input type="checkbox" v-model='filter.hazard'>
            <i class="form-icon"></i>
            <img src="{{ asset('images/hazard_n_icon.png') }}" style='height: 20px; vertical-align: middle; display:inline-block;' alt="">
            <span style='user-select: none;'>
                Hazards
            </span>
        </label>
    </div>
    <div class="form-group">
        <label class="form-checkbox">
            <input type="checkbox" v-model='filter.threatening'>
            <i class="form-icon" style=''></i>
            <img src="{{ asset('images/threatening_n_icon.png') }}" style='height: 20px; display:inline-block;' alt="">
            <span style='user-select: none;'>
                Threatening Incident
            </span>
        </label>
    </div>

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
                            <input type="radio" name="type" value='crash_near_miss' v-model='incident.type'>
                            <i class="form-icon"></i> Crash / Near Miss
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
                                <input type="radio" value='vandalism' v-model='incident.threatening_data.type'>
                                <i class="form-icon"></i> Vandalism
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='harassment' v-model='incident.threatening_data.type'>
                                <i class="form-icon"></i> Harassment
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='insecurity' v-model='incident.threatening_data.type'>
                                <i class="form-icon"></i> Insecurity
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='other' v-model='incident.threatening_data.type'>
                                <i class="form-icon"></i> other
                            </label>
                        </div>
                    </div>
                    <div class='app-accident-data'  v-if="incident.type == 'crash_near_miss'">
                        <div class='form-group'>
                            <label class="form-label text-bold">Type</label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='crash' v-model='incident.crash_data.type'>
                                <i class="form-icon"></i> Crash
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='near miss' v-model='incident.crash_data.type'>
                                <i class="form-icon"></i> Near Miss
                            </label>
                        </div>
                        <div class='form-group'>
                            <label class="form-label text-bold">Number of involved</label>
                            <label class='form-label form-inline' style='max-width: 100px;'>
                                Bikes
                                <input class="form-input" type="text" style='max-width: 100px;' v-model='incident.crash_data.number_involved_bikes' @keypress="isNumber($event)">
                            </label>
                            <label class='form-label form-inline'>
                                Vehicles
                                <input class="form-input" type="text" style='max-width: 100px;' v-model='incident.crash_data.number_involved_vehicles' @keypress="isNumber($event)">
                            </label>
                            <label class='form-label form-inline'>
                                Pedesterians
                                <input class="form-input" type="text" style='max-width: 100px;' v-model='incident.crash_data.number_involved_pedesterians' @keypress="isNumber($event)">
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-label text-bold">Are you involved in the crash / near miss?</label>
                            <label class="form-radio form-inline">
                                <input type="radio" v-model='incident.crash_data.reporter_involved' v-bind:value="true">
                                <i class="form-icon"></i> Yes
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" v-model="incident.crash_data.reporter_involved" v-bind:value="false">
                                <i class="form-icon"></i> No
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-label text-bold">Which of the following are you?</label>
                            <label class="form-radio form-inline">
                                <input type="radio" v-model='incident.crash_data.reporter_type' value="pedesterian">
                                <i class="form-icon"></i> Pedesterian
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" v-model='incident.crash_data.reporter_type' value="public transit user">
                                <i class="form-icon"></i> Public Transit User
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" v-model='incident.crash_data.reporter_type' value="cyclist">
                                <i class="form-icon"></i> Cyclist
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" v-model='incident.crash_data.reporter_type' value="motorist">
                                <i class="form-icon"></i> Motorist
                            </label>
                        </div>
                        
                        <div class='form-group'>
                            <label class="form-label text-bold">Type of collision</label>
                            <input class="form-input" type="text" v-model='incident.crash_data.type_of_collision'>
                        </div>

                        <div class='form-group'>
                            <label class="form-label text-bold">Number of injuries</label>
                            <input class="form-input" type="text" style='max-width: 100px;' v-model='incident.crash_data.number_of_injuries' @keypress="isNumber($event)">
                        </div>

                        <div class='form-group'>
                            <label class="form-label text-bold">Number of fatalities</label>
                            <input class="form-input" type="text" style='max-width: 100px;' v-model='incident.crash_data.number_of_fatalities' @keypress="isNumber($event)">
                        </div>
                    </div>

                    <div class='app-hazard-data'  v-if="incident.type == 'hazard'">
                        <div class='form-group'>
                            <label class='form-label text-bold'>Type</label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='road' v-model="incident.hazard_data.type">
                                <i class="form-icon"></i> Road
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='sidewalk' v-model="incident.hazard_data.type">
                                <i class="form-icon"></i> Sidewalk
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='bus' v-model="incident.hazard_data.type">
                                <i class="form-icon"></i> Bus
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='bike lane' v-model="incident.hazard_data.type">
                                <i class="form-icon"></i> Bike lane
                            </label>
                            <label class="form-radio form-inline">
                                <input type="radio" value='other' v-model="incident.hazard_data.type">
                                <i class="form-icon"></i> other
                            </label>
                        </div>
                    </div>
                    
                    <div v-show="incident.type">
                        <div class='form-group'>
                            <label class="form-label text-bold">Tell us more about what happened</label>
                            <textarea v-model="incident.description" class="form-input" cols="30" rows="3"></textarea>
                        </div>
    
                        <div class='form-group text-bold'>
                            <label class="form-label">Upload photos or videos</label>
                            <div class='dropzone' id='files-uploader'>
                            
                            </div>
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