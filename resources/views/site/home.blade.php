
@extends('site.layouts.basic')

@section('title', __('Home'))

@section('content')
<div class='Map-Module' id='map'></div>
<div class='Actions'>
  <button id='app-add-incident' data-micromodal-trigger="modal-1">Add incident</button>
</div>
<div class='Map-Filter'>
  <label for="accidents">
    <input type="checkbox" id='accidents'>
    Accidents
  </label>
  <label for="hazards">
    <input type="checkbox" id='hazards'>
    Hazards
  </label>
  
</div>

<div class="modal" id="add-incident-modal">
  <div class="modal-overlay" aria-label="Close"></div>
  <div class="modal-container">
    <div class="modal-header">
      <a href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
      <div class="modal-title h5">Add Incident</div>
    </div>
    <div class="modal-body">
      <div class="content">
        <form class='app-incident-form'>
          <!-- content here -->
          <input type="hidden" name='lat' class='lat'>
          <input type="hidden" name='lng' class='lng'>

          <!-- form input control -->
          <div class="form-group">
            <label class="form-label" for="input-example-1">Name</label>
            <input class="form-input" type="text" id="input-example-1" placeholder="Name">
          </div>

          <input type="submit">
        </form>
      </div>
    </div>
    <div class="modal-footer">
      ...
    </div>
  </div>
</div>
        
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgUrAcFPriGCar9g7_3lwYLGOHpjN59rY"
  type="text/javascript"></script>
@endsection
