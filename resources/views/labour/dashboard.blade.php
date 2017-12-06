@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
      
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">USER Dashboard</div>

              <div class="panel-body">
                  You are logged in as <strong>USER</strong>!
              </div>
          </div>
      </div>

      <!-- 
      @if( Auth::user() )
        <div class="col-sm-2">
          <div class="profile photo img-circle">
            <i class="glyphicon gi-4x glyphicon-user"></i>
          </div>
        </div>
        <div class="col-sm-10">

              <h3>{{ Auth::user()->email }}</h3>
  
              <div class="form-group">
                <div for="name">E-mail
                  <div name="email" type="text" class="form-control" value="<?php echo $user->email; ?>" placeholder="Type your e-mail">
                </div>
              </div>
              <div class="form-group">
                <div for="phone">Phone
                  <div name="phone" type="text" class="form-control" value="<?php echo $user->phone; ?>"></div>
                </div>
              </div>
              <div class="form-group">
                <div  class="form-group" for="password">Role
                  <div name="role" type="text" class="form-control"  value="<?php echo $user->role; ?>"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-group" for="repass">Unit
                  <?php $address = $user->ad_unit.'/'.$user->ad_number.' '.$user->ad_street.' '.$user->ad_city; ?>
                  <div name="address" type="text" class="form-control" value="<?php echo $user->ad_unit; ?>"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-group" for="repass">Number
                  <div name="address" type="text" class="form-control" value="<?php echo $user->ad_number; ?>"></div>
                </div>
              </div>
              <div class="form-group">
                <div for="repass">Street
                  <div name="address" type="text" class="form-control" value="<?php echo $user->ad_street; ?>"></div>
                </div>
              </div>
              <div class="form-group">
                <div for="repass">City
                  <div name="city" type="text" class="form-control" value="<?php echo $user->ad_city; ?>"></div>
                </div>
              </div>
              <div class="form-group">
                <div for="repass">State
                  <div name="address" type="text" class="form-control" value="<?php echo $user->ad_state; ?>"></div>
                </div>
              </div>
              <div class="form-group">
                <div for="repass">Postal Code
                  <div name="address" type="text" class="form-control" value="<?php echo $user->ad_zip; ?>"></div>
                </div>
              </div>
              <div class="form-group">
                <div for="repass">Country
                  <div name="country" type="text" class="form-control" value="<?php echo $user->ad_country; ?>"></div>
                </div>
              </div>

        </div>
      @endif -->
    
    </div>
  </main>
<script type="text/javascript">
  var now = moment().format('YYYY-MM-DD h:hh:ss')
  $('input[name="date_created"]').val(now);
</script>

@endsection
