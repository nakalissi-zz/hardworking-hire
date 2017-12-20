@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">

      <h3>Allocations Labour</h3>
      <?php if(isset($allocations)){ ?>
        <table class="table allocations">
          <tr>
            <th>Description</th>
            <th>Address</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Jobs Status</th>
          </tr>
        <?php foreach ($allocations as $key => $value) { ?>

          <tr id="<?php echo $key ?>" onclick="window.location='labour/allocation/<?php echo $value->alloc_id; ?>'">
            <!-- ACL Admin only -->
            <td><?php echo $value->job_description; ?></td>
            <td><?php echo $value->alloc_address; ?></td>
            <td><?php echo $value->alloc_init; ?></td>
            <td><?php echo $value->alloc_end; ?></td>
            <?php
              if ($value->alloc_status == 'allocated') {
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
  var now = moment().format('YYYY-MM-DD h:hh:ss')
  $('input[name="date_created"]').val(now);
</script>

@endsection
