@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
        <div class="col-sm-12">
          <?php if(Session::get('message')) { ?>
            <div class="alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> <?php echo Session::get('message'); ?>
            </div>
          <?php } ?>
          <form class="form-horizontal" action="/labour/allocate" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="job_id" value="<?php echo $job->job_id; ?>">
            <input type="hidden" name="builder_id" value="<?php echo $job->builder_id; ?>">
            <input type="hidden" name="job_name" value="<?php echo $job->job_name; ?>">
            <input type="hidden" name="job_description" value="<?php echo $job->job_description; ?>">
            <input type="hidden" name="job_address" value="<?php echo $job->job_address; ?>">
            <input type="hidden" name="job_init" value="<?php echo $job->job_init; ?>">
            <input type="hidden" name="job_end" value="<?php echo $job->job_end; ?>">
            <h3>Allocate Labour</h3>
            
            <div class="job-title">
              <strong>Job Title</strong>
              <p><?php echo $job->job_name; ?></p>
            </div>
            
            <div class="job-description">
              <strong>Job Description</strong>
              <p><?php echo $job->job_description; ?></p>
            </div>
            
            <div class="job-description">
              <strong>Where</strong>
              <p><?php echo $job->job_address; ?></p>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <strong>Start Date</strong>
                <div class="input-group">
                  <?php echo $job->job_init; ?>
                </div>
              </div>
              <div class="col-sm-6">
                <strong>End Date</strong>
                <div class="input-group">
                  <?php echo $job->job_end; ?>
                </div>
              </div>
            </div>

            <p>&nbsp;</p>
            <button type="submit" class="btn btn-block btn-primary">Assign Job</button>
          </form>
        </div>
    </div>
  </main>
  <script type="text/javascript">
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  var placeSearch, autocomplete;
  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    // for (var component in componentForm) {
    //   console.log(component);
    //   document.getElementById(component).value = '';
    //   document.getElementById(component).disabled = false;
    // }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
      }
    }
  }

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }

  window.onload = initAutocomplete();
  </script>

@endsection
