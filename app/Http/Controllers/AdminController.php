<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      var_dump(Auth::admin()->id);
      $projects = DB::table('jobs')
        ->where('user_id',$user_id)
        ->first();

      return view('builder.dashboard', [
        'projects' => $projects,
        'allocations' => $allocations
      ]);
    }
    
    /**
      * Get all users
    */
    public function get($builder = ''){
      if ($builder) {
        $builder = DB::table('admins')->where('name',$builder)->first();
        return view('builder/', ['user' => $builder]);
      }
    }
    
    public function add(Request $request){

      $input = Input::all();

      // `user_id`, `username`, `first_name`, `last_name`, `password`, `email`, `phone`, `role`, `ad_unit`, `ad_number`, `ad_street`, `ad_city`, `ad_state`, `ad_zip`, `data_created`, `date_updated`, `ip_address`, `last_login`, `status`, `alloc`
      $array = array(
        'business_name' => $input['business_name'],
        'email' => $input['email'],
        'phone' => $input['phone'],
        'password' => md5($input['password']),
        'email' => $input['email'],
        'date_created' => $input['date_created'],
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'status' => 'new',
      );

      if (!DB::table('admins')->where('email', '=', Input::get('email'))->exists()) {

        if (isset($array)) {
          $insert = DB::table('admins')->insertGetId($array);
          if ($insert) {
            // $value = $request->session()->get('key');
            // $request->session()->flash('status', 'Client included successfully!');
            // return redirect('register', ['status','Client included successfully!']);
          } else {
            // return redirect('errors/503');
          }
        }

      } else {
        return view('/builder/register');
        // return redirect('register', ['errors','E-mail already exists.']);
      }

      // var_dump($request->session());

    }
    
    public function allocationsView(){
      return view('builder.allocations');
    }
    
    public function jobsView(){
      $jobs = DB::table('jobs')
      ->leftJoin('admins', 'admins.id', '=', 'jobs.builder_id')
      ->where('admins.id',1)
      ->orderBy('jobs.created_at', 'desc')
      ->get();
      return view('builder/jobs', ['jobs' => $jobs]);
    }
    
    /**
     * Offer a new position.
     *
     * @return \Illuminate\Http\Response
     */
    public function addjob($job = ''){
      if (isset($job)) {

        $input = Input::all();

        $array = array(
          'business_name' => $input['business_name'],
          'email' => $input['email'],
          'phone' => $input['phone'],
          'password' => md5($input['password']),
          'email' => $input['email'],
          'date_created' => $input['date_created'],
          'ip_address' => $_SERVER['REMOTE_ADDR'],
          'status' => 'new',
        );

        // var_dump($request->session());

        if (isset($array)) {
          $insert = DB::table('admins')->insertGetId($array);
          if ($insert) {
            // $value = $request->session()->get('key');
            // $request->session()->flash('status', 'Client included successfully!');
            return view('/builder', ['status', 'Client included successfully!']);
          } else {
            return view('errors/503');
          }
        }
      }
    }
}
