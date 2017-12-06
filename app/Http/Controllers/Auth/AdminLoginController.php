<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\MailController;

use Hash;
use Validator;

class AdminLoginController extends Controller
{
    public function __construct(){
      $this->middleware('guest:admin');
    }
    
    public function loginForm(){
      return view('auth.admin-login');
    }
    
    public function registerForm()
    {
        return view('auth.admin-register');
    }
    
    public function register(Request $request){
      
      $rules = array(
        'firstname' => 'required',
        'lastname' => 'required',
        'email'  => 'required|email|unique:admins',
        'password' => 'required|min:6'
      );
      
      $validator = Validator::make($request, $rules);
      
      $builder = new Admin();
      $builder->firstname = $request->input('firstname');
      $builder->lastname = $request->input('lastname');
      $builder->email = $request->input('email');
      $builder->password = Hash::make($request->input('password'));
      
      try {
        $builder->save();
        MailController::send($request);
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
        return redirect()->intended('admin.dashboard');
      } else {
        return redirect()->back();
      }
      
    }
}
