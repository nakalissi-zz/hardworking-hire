@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
        <div class="col-sm-12">
          <h3>Allocations Labour</h3>
          <?php if(isset($allocations)){ ?>
            <table class="table allocations">
              <tr>
                <th>Job</th>
                <th>Description</th>
                <th>Address</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Jobs Status</th>
              </tr>
            <?php foreach ($allocations as $key => $value) { ?>
          
              <tr id="<?php echo $key ?>" onclick="window.location='allocation/<?php echo $value->alloc_id; ?>'">
                <!-- ACL Admin only -->
                <td><?php echo $value->job_name; ?></td>
                <td><?php echo $value->job_description; ?></td>
                <td><?php echo $value->alloc_address; ?></td>
                <td><?php echo $value->alloc_init; ?></td>
                <td><?php echo $value->alloc_end; ?></td>
                <?php
                  if ($value->alloc_status == 'confirmed') {
                    $badge = ' label-success';
                  } else if($value->alloc_status == 'pending'){
                    $badge = ' label-warning';
                  } else if($value->alloc_status == 'expired'){
                    $badge = ' label-danger';
                  } else if($value->alloc_status == 'canceled'){
                    $badge = ' label-danger';
                  } else {
                    $badge = ' label-default';
                  }
                ?>
                <td><span class="label<?php echo $badge?>"><?php echo $value->alloc_status; ?></span></td>

              </tr>
            <?php } ?>
            </table>
          <?php } else {
            echo "No allocations found.";
          } ?>
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
