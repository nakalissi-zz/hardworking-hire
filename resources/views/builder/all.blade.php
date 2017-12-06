@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
        <div class="col-sm-12">
          <h3>All Registered Builders</h3>
          <?php if (isset($clients)) { ?>
            <table class="table">
              <tr>
                <th>#ID</th>
                <th>Business</th>
                <th>Phone Number</th>
                <th>E-mail</th>
                <th>Date Created</th>
              </tr>
            <?php foreach ($clients as $key => $value) { ?>
              <tr>
                <td>
                  <input type="checkbox" name="client[]" value="<?php echo $value->client_id; ?>">
                </td>
                <td><?php echo $value->business_name; ?></td>
                <td><?php echo $value->phone; ?></td>
                <td><?php echo $value->email; ?></td>
                <td><?php echo $value->date_created; ?></td>
              </tr>
            <?php } ?>
            </table>
          <?php } else { ?>
            <p class="text-center text-danger"><i class="glyphicon glyphicon-exclamation-sign"></i> There's no clients registered.</p>
          <?php } ?>
        </div>
    </div>
  </main>


@endsection
