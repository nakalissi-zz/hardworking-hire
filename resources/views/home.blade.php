@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
      <div class="col-sm-6">
        <h2>Builder Area</h2>
      </div>
      <div class="col-sm-6">
        <h2>Labour Area</h2>
      </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
          <h3>All available jobs</h3>

          <?php if (isset($jobs)) { ?>
            <table class="table allocation">
              <tr>
                <th>Builder</th>
                <th>Phone Number</th>
                <th>E-mail</th>
                <th>Job Name</th>
                <th>Job Description</th>
                <th>Available Positions</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Jobs Status</th>
              </tr>
            <?php foreach ($jobs as $key => $value) { ?>
              <?php if ($value->positions > 0) { ?>
                <tr id="<?php echo $key ?>" class="enabled" onclick="window.location='job/<?php echo $value->job_id; ?>'">
              <?php } else { ?>
                <tr id="<?php echo $key ?>" class="disabled">
              <?php } ?>
                <!-- ACL Admin only -->
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->phone; ?></td>
                <td><?php echo $value->email; ?></td>
                <td><?php echo $value->job_name; ?></td>
                <td><?php echo $value->job_description; ?></td>
                <td><?php echo $value->positions; ?></td>
                <td><?php echo $value->job_init; ?></td>
                <td><?php echo $value->job_end; ?></td>
                <?php
                $badge = '';
                  if ($value->status == 'new') {
                    $badge = ' badge-primary';
                  } else if($value->status == 'available'){
                    $badge = ' badge-success';
                  } else if($value->status == 'allocated'){
                    $badge = ' badge-danger';
                  }
                ?>
                <td><span class="badge<?php echo $badge?>"><?php echo $value->job_status; ?></span></td>

              </tr>
            <?php } ?>
            </table>
          <?php } else { ?>
            <p class="text-center text-danger">
              <i class="glyphicon glyphicon-exclamation-sign"></i>
              There's no jobs registered.</p>
          <?php } ?>
        </div>
    </div>
  </main>


@endsection
