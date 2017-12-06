@extends('layouts.app')

@section('content')

  <main class="container timesheet">

        <div class="row">
          <div class="col-sm-12">
            <form class="form-inline" name="formTimesheet" id="formTimesheet" action="/labour/timesheet/new" method="post">

              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="labour_id" value="<?php echo $labour_id; ?>">
              <input type="hidden" name="builder_id" value="<?php echo $builder[0]->id; ?>">
              <input type="hidden" name="alloc_id" value="<?php echo $alloc_id; ?>">

              <div class="form-group">
                  <label for="date">Date</label>
                  <div id="datepicker" class="input-group">
                    <input name="date" class="form-control datepicker" data-date-format="yyyy-mm-dd" type="text" placeholder="Select date">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="start_time">Start Time</label>
                  <div id="datepicker" class="input-group">
                    <input name="start_time" class="form-control timepicker" type="text" placeholder="Select start time">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-time"></i>
                    </span>
                  </div>
                </div>
          
                <div class="form-group">  
                    <label for="end_time">End Time</label>
                    <div id="datepicker" class="input-group">
                      <input name="end_time" class="form-control timepicker" type="text" placeholder="Select end time">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-time"></i>
                      </span>
                    </div>
                </div>

            <button type="submit" class="btn btn-primary submit-button">Submit</button>
    
          </form>
        </div>
        </div>
        
        <div class="row">
          <div class="col-sm-12">
            <h3>Employer's Name: <?php echo $builder[0]->firstname; ?>
            </h3>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
          <?php if(!empty($timesheet)){ ?>
          <table class="table">
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Start time</th>
              <th>End time</th>
            </tr>
            <?php foreach ($timesheet as $key => $value) { ?>
            <tr>
              <td><i class="fa fa-trash"></i></td>
              <td><?php echo $value->date; ?></td>
              <td><?php echo $value->start_time; ?></td>
              <td><?php echo $value->end_time; ?></td>
            </tr>
            <?php } ?>
          </table>
          </div>
        </div>
        
        <div class="row signature">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <p>Responsible Signature</p>
          </div>
        </div>
        <?php 
        } else { ?>
        <div class="row">
          <div class="col-sm-12">
            <h4>No registers found.</h4>
          </div>
        </div>

        <?php }?>

  </main>
<script type="text/javascript">
  $(function(){
    $('.timepicker').mask('00:00:00');
  });
</script>
@endsection
