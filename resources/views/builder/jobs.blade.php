@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
        <div class="col-sm-12">
          <h3>All Registered Jobs</h3>
          <?php if(Session::get('message')) { ?>
            <div class="alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> <?php echo Session::get('message'); ?>
            </div>
          <?php } ?>
          <?php if (isset($jobs)) { ?>
            <table class="table">
              <tr>
                <th>Del</th>
                <th>Job</th>
                <th>Description</th>
                <th>Address</th>
                <th>Status</th>
              </tr>
            <?php foreach ($jobs as $key => $value) { ?>
              <tr>
                <td>
                  <a href="/job/<?php echo $value->job_id; ?>"><i class="fa fa-trash"></i></a>
                </td>
                <td><?php echo $value->job_name; ?></td>
                <td><?php echo $value->job_description; ?></td>
                <td><?php echo $value->job_address; ?></td>
                <td><?php echo $value->job_status; ?></td>
              </tr>
            <?php } ?>
            </table>
          <?php } else { ?>
            <p class="text-center text-danger"><i class="glyphicon glyphicon-exclamation-sign"></i> There's no jobs registered.</p>
          <?php } ?>
        </div>
    </div>
  </main>


@endsection
