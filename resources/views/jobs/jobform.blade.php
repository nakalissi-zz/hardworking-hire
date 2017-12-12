@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
        <div class="col-sm-12">
          <form class="formSignup" name="formJob" id="formJob" action="/jobs/addjob" method="post">
            <h3>Create New Job</h3>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="job_name">Job Title
              <input name="job_name" type="text" class="form-control" placeholder="Type the job title">
            </label>
            <label for="job_description">Job Description
              <textarea class="form-control" name="job_description" rows="8" cols="80"></textarea>
            </label>
            <label for="client">Builder
              <select class="form-control" name="builder_id">
                <option value="">Select builder</option>
                <?php foreach($builders as $key => $value) { ?>
                  <option value="<?php echo $value->id; ?>"><?php echo $value->name ?></option>
                <?php } ?>
              </select>
            </label>
            <label for="job_name">Positions Available
              <input name="job_positions" type="text" class="form-control" placeholder="Type the positions available">
            </label>
            <label for="job_name">Place
              <input name="job_address" type="text" class="form-control" placeholder="Type the job address">
            </label>
            <div class="row">
              <div class="col-sm-6">
                <label for="job_init">Start Date
                  <div class="input-group" data-datepicker-format="yyyy-mm-dd">
                    <input name="date_init" class="form-control datepicker" type="text" placeholder="Select init date">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                  </div>
                </label>
              </div>
              <div class="col-sm-6">
                <label for="job_init">End Date
                  <div class="input-group" data-datepicker-format="yyyy-mm-dd">
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

@endsection
