@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ADMIN Dashboard</div>

                <div class="panel-body">
                  @if (Auth::guard('admin')->check())
                      Currently logged in as customer {{ Auth::guard('admin')->user()->name }}
                  @endif
                  You are logged in as <strong>{{ Auth::guard('admin')->user() }}</strong>
                  <?php dump(Auth::guard('admin')->user()) ?>
                  <?php dump($user); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
