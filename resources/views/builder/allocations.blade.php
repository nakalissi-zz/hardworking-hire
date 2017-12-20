@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
        <div class="col-sm-12">
          <h3>Allocations Labour</h3>
          <?php if(Session::get('message')) { ?>
            <div class="alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> <?php echo Session::get('message'); ?>
            </div>
          <?php } ?>
          <?php if(isset($allocations)){ ?>
            <table class="table allocation">
              <tr>
                <th>Job</th>
                <th>Description</th>
                <th>Address</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Jobs Status</th>
              </tr>
            <?php foreach ($allocations as $key => $value) { ?>
              <tr id="<?php echo $key ?>">
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

@endsection
