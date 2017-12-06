@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row">
        <div class="col-sm-12">
          {{$request}}
          <form class="" action="" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="name" value="Type your login">
              <input type="password" class="form-control" name="password" placeholder="Type your password">
              <input type="submit" class="form-control" value="Send">
            </div>
          </form>
        </div>
    </div>
  </main>


@endsection
