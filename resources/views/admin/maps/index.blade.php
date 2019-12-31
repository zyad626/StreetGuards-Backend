@extends('admin.layouts.base')

@section('title', 'Incidents')

@section('content')
<div class='Map-Module' id='map'></div>

<div class='Map-Filter' id='map_filter'>
    <div class="form-group">
        <label class="form-checkbox">
            <input type="checkbox" v-model='filter.crash_near_miss'>
            <i class="form-icon" style='top: 0.8rem;'></i>
            <span style='user-select: none;'>
                Crash / Near Miss
            </span>
            <img src="{{ asset('images/crash.png') }}" style='height: 50px; vertical-align: middle; display:inline-block;' alt="">
        </label>
    </div>
    <div class="form-group">
        <label class="form-checkbox">
            <input type="checkbox" v-model='filter.hazard'>
            <i class="form-icon" style='top: 0.8rem;'></i>
            <span style='user-select: none;'>
                Hazards
            </span>
            <img src="{{ asset('images/hazard.png') }}" style='height: 50px; vertical-align: middle; display:inline-block;' alt="">
        </label>
    </div>
    <div class="form-group">
        <label class="form-checkbox">
            <input type="checkbox" v-model='filter.threatening'>
            <i class="form-icon" style='top: 0.8rem;'></i>
            <span style='user-select: none;'>
                Threatening Harrasment
            </span>
            <img src="{{ asset('images/incident.png') }}" style='height: 50px; vertical-align: middle; display:inline-block;' alt="">
        </label>
    </div>

</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgUrAcFPriGCar9g7_3lwYLGOHpjN59rY"
    type="text/javascript"></script>
@endsection
