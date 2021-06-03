@extends('admin.layouts.base')

@section('title', 'Incidents')

@section('content')

<input
    id="pac-input"
    class="controls"
    type="text"
    placeholder="Search Box"
    autofocus
/>
<div class='Map-Module' id='map'></div>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_1fyKerAdiVuPk8GOGBV11O0ZrFGvB8g&libraries=places"
    type="text/javascript"></script>
@endsection
