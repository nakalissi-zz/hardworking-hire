@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
        <div class="col-sm-12">
          <h3>All available jobs</h3>
          <?php if (isset($jobs)) { ?>
            <table class="table allocation">
              <tr>
                <th>#ID</th>
                <th>Business</th>
                <th>Phone Number</th>
                <th>E-mail</th>
                <th>Job Name</th>
                <th>Job Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Jobs Status</th>
              </tr>
            <?php foreach ($jobs as $key => $value) { ?>
              <tr id="<?php echo $key ?>">
                <!-- ACL Admin only -->
                <td>
                  <a href="/jobs/<?php echo $value->job_id; ?>"><i class="glyphicon glyphicon-link"></i></a>
                </td>
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->phone; ?></td>
                <td><?php echo $value->email; ?></td>
                <td><?php echo $value->job_name; ?></td>
                <td><?php echo $value->job_description; ?></td>
                <td><?php echo $value->job_init; ?></td>
                <td><?php echo $value->job_end; ?></td>
                <?php
                  if ($value->status == 'new') {
                    $badge = ' badge-primary';
                  } else if($value->status == 'available'){
                    $badge = ' badge-success';
                  } else if($value->status == 'allocated'){
                    $badge = ' badge-danger';
                  } else {
                    $badge = ' badge-default';
                  }
                ?>
                <td><span class="badge<?php echo $badge?>"><?php echo $value->status; ?></span></td>

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
