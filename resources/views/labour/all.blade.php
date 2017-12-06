@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
        <div class="col-sm-12">
          <h3>All available labours</h3>
          <?php var_dump($users); ?>
          <?php if (isset($users)) { ?>
            <table class="table allocation">
              <tr>
                <thead>
                  <th>#ID</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>E-mail</th>
                  <th>Area</th>
                  <th>Address</th>
                  <th>Jobs Status</th>
                </thead>
              </tr>
            <?php foreach ($users as $key => $value) {
              $name = (isset($value->firstname))?$value->firstname:'';
              $name .= (isset($value->lastname))?$value->lastname:'-';
              $phone = (isset($value->phone))?$value->phone:'-';
              $email = (isset($value->email))?$value->email:'-';
              $role = (isset($value->role))?$value->role:'-';
              $address = (isset($value->ad_unit))?$value->ad_unit.'/':'';
              $address .= (isset($value->ad_number))?$value->ad_number.' ':'';
              $address .= (isset($value->ad_street))?$value->ad_street.' ':'';
              $address .= (isset($value->ad_zip))?$value->ad_zip.' ':'';
              $address .= (isset($value->ad_city))?$value->ad_city.' ':'';
              $address .= (isset($value->ad_state))?$value->ad_state.' ':'';
              $address .= (isset($value->ad_country))?$value->ad_country:'-';
              $status = (isset($value->status))?$value->status:'';
              // $value->ad_unit.'/'.$value->ad_number.' '.$value->ad_street.' '.$value->ad_zip.' '.$value->ad_city.' '.$value->state.' '.$value->country;
              ?>
              <tr id="<?php echo $key ?>">
                <!-- ACL Admin only -->
                <td>
                  <input type="checkbox" name="job[]" value="<?php echo $value->user_id; ?>">
                </td>
                <td><?php echo $name; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $role; ?></td>
                <td><?php echo $address; ?></td>
                <?php
                  if ($status == 'new') {
                    $badge = ' badge-primary';
                  } else if($status == 'available'){
                    $badge = ' badge-success';
                  } else if($status == 'allocated'){
                    $badge = ' badge-danger';
                  }
                ?>
                <td><span class="badge<?php echo $badge?>"><?php echo $status; ?></span></td>

              </tr>
            <?php } ?>
            </table>
          <?php } else { ?>
            <p class="text-center text-danger">
              <i class="glyphicon glyphicon-exclamation-sign"></i>
              There's no users registered.</p>
          <?php } ?>
        </div>

    </div>
  </main>


@endsection
