@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
        <div class="col-sm-12">
          <form class="formSignup" name="formJob" id="formAllocateUser" action="/users/allocate" method="post">
            <h3>Allocate Labour</h3>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <?php foreach ($job as $key => $value) { ?>
              <input type="hidden" name="job_id" value="<?php echo $value->job_id ?>">
              <label for="job_name">Job Title
                <input name="job_name" type="text" class="form-control" placeholder="Type the job title" value="<?php echo $value->job_name; ?>" disabled>
              </label>
              <label for="job_description">Job Description
                <textarea class="form-control" name="job_description" rows="8" cols="80" disabled>
                  <?php echo trim($value->job_description); ?>
                </textarea>
              </label>
            <?php } ?>

            <label for="client">Companies
              <select class="form-control" name="client_id">
                <option value=""></option>
                <?php foreach ($clients as $key => $value) {
                  echo '<option value="'.$value->client_id.'">'.$value->business_name.'</option>';
                } ?>
              </select>
            </label>
            <label for="users">Labours
              <select class="form-control" name="user_id">
                <option value=""></option>
                <?php foreach ($users as $key => $value) {
                  echo '<option value="'.$value->user_id.'">'.$value->firstname.' '.$value->lastname.'</option>';
                } ?>
              </select>
            </label>
            <label for="job_address">Place
              <input id="autocomplete" onfocus="geolocate()" name="job_address" type="text" class="form-control" placeholder="Type the job address">
            </label>
            <div class="row">
              <div class="col-sm-6">
                <label for="job_init">Start Date
                  <div class="input-group">
                    <input name="date_init" class="form-control datepicker" data-datepicker-format="yyyy-mm-dd" type="text" placeholder="Select init date">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                  </div>
                </label>
              </div>
              <div class="col-sm-6">
                <label for="job_init">End Date
                  <div class="input-group">
                    <input name="date_end" class="form-control datepicker" type="text" placeholder="Select end date">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                  </div>
                </label>
              </div>
            </div>

            <p>&nbsp;</p>
            <button type="submit" class="btn btn-block btn-primary">Submit</button>
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
