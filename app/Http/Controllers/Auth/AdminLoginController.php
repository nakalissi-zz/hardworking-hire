<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MailController;

use Hash;
use Validator;

class AdminLoginController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function loginForm(){
      return view('auth.admin-login');
    }

    public function registerForm()
    {
        return view('auth.admin-register');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('builder.dashboard');
    }

    public function register(Request $request){
      
      $this->validate($request, [
        'firstname' => 'required',
        'lastname' => 'required',
        'email'  => 'required|email|unique:admins',
        'password' => 'required|min:6'
      ]);

      $builder = new Admin();
      $builder->name = $request->input('name');
      $builder->abn = $request->input('abn');
      $builder->email = $request->input('email');
      $builder->password = Hash::make($request->input('password'));

      try {
        $builder->save();
        // MailController::send($request);
      } catch (Exception $e) {
        var_dump($e);
      }

    }

    public function login(Request $request){

      $this->validate($request, [
        'email'  => 'required|email',
        'password' => 'required|min:6'
      ]);

      // create our user data for the authentication
      $credentials = array(
        'email' => $request->input('email'),
        'password'  => $request->input('password')
      );

      // Attempt to log admin users
      if(Auth::guard('admin')->attempt($credentials, $request->input('remember'))){
        $user_id = Auth::guard('admin')->id();
        var_dump($user_id);
        $this->user = Admin::find($user_id);
        dump($this->user['attributes']);
        // return redirect()->intended('builder');
      } else {
        return redirect()->back();
      }

    }
    
    /**
      * Get admin user
    */
    public function get($builder = ''){
      if ($builder) {
        $builder = DB::table('admins')->where('name',$builder)->first();
        return view('builder/', ['user' => $builder]);
      }
    }

    public function add(Request $request){

      $input = Input::all();

      $array = array(
        'name' => $input['business_name'],
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

          } else {
            return redirect('errors/503');
          }
        }

      } else {
        return view('/builder/register');
      }

    }

    public function allocationsView(){
      
      $builder_id = Auth::guard('admin')->id();
      $user = auth()->guard('admin')->user();
      dump('builder id '.$builder_id . ' ' . $user);
      $allocations = Allocation::where('builder_id',$builder_id)
        ->first();
      return view('builder.allocations', [
        'allocations' => $allocations
      ]);
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
          'name' => $input['business_name'],
          'email' => $input['email'],
          'phone' => $input['phone'],
          'password' => md5($input['password']),
          'email' => $input['email'],
          'date_created' => $input['date_created'],
          'ip_address' => $_SERVER['REMOTE_ADDR'],
          'status' => 'new',
        );

        if (isset($array)) {
          $insert = DB::table('admins')->insertGetId($array);
          if ($insert) {
            return view('/builder', ['status', 'Client included successfully!']);
          } else {
            return view('errors/503');
          }
        }
      }
    }
}
