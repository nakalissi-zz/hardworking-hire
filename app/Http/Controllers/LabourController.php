<?php

namespace App\Http\Controllers;

// Models
use App\User;
use App\Admin;
use App\Allocation;
use App\Job;
use App\Timesheet;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\MailController;
use Session;
use Hash;
use App\Events\Event;

class LabourController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // Auth::loginUsingId(1);
        // $role = Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $labour_id = Auth::id();

      $allocations = DB::table('allocations')
        ->where('allocations.labour_id',$labour_id)
        ->leftJoin('jobs', 'jobs.builder_id', '=', 'allocations.builder_id')
        ->orderBy('jobs.updated_at','desc')
        ->get();

      return view('labour/dashboard', [
        'allocations' => $allocations
      ]);
    }

    /**
    * Get user labour by labour id
    */
    public function get($user_id = ''){

      if ($user_id) {
        $profile = DB::table('users')
          ->where('user_id',$user_id)
          ->first();

        return view('labour/dashboard', ['user' => $profile]);
      }
    }

    public function allocations(Request $request){

      // var_dump(Auth::user());
      $user_id = Auth::user()->id;

      $getAllocUser = DB::table('allocations')
        ->leftJoin('jobs', 'jobs.job_id', '=', 'allocations.job_id')
        ->where('allocations.labour_id',$user_id)
        ->orderBy('allocations.created_at','desc')
        ->get();
        dump($getAllocUser);
      return view('/labour/allocations', [
        'allocations' => $getAllocUser
      ]);

    }

    public function timesheetView($alloc_id = ''){

      // var_dump(Auth::user());
      $user_id = Auth::user()->id;
      $input = Input::all();

      $getAllocTimesheet = DB::table('timesheet')
        ->leftJoin('allocations', 'allocations.alloc_id', '=', 'timesheet.alloc_id')
        ->where('allocations.labour_id',$user_id)
        ->orderBy('date','desc')
        ->get();

      $getBuilder = DB::table('admins')
        ->where('admins.id',1)
        ->get();

      return view('/labour/timesheet', [
        'labour_id' => $user_id,
        'builder' => $getBuilder,
        'alloc_id' => $alloc_id,
        'timesheet' => $getAllocTimesheet
      ]);

    }

    /**
     * Add new timesheet entry.
     */
    public function timesheetNew(){

      $input = Input::all();

      $timesheet = new Timesheet();
      $timesheet->builder_id = $input['builder_id'];
      $timesheet->labour_id = Auth::user()->id;
      $timesheet->alloc_id = $input['alloc_id'];
      $timesheet->date = $input['date'];
      $timesheet->start_time = $input['start_time'];
      $timesheet->end_time = $input['end_time'];
      $timesheet->ip_address = $_SERVER['REMOTE_ADDR'];

      try {
        $timesheet->save();
        return redirect()->back()->with('message', 'Register created!');
      } catch (Exception $e) {
        return view('errors/503', $e);
      }
    }

    public function timesheetDel($id = ''){
      if(!empty($id)){
        DB::table('timesheet')->where('id',$id)->delete();
      }
      return redirect()->back()->with('message', 'Register delete successfully!');
    }

    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendEmailReminder(Request $request, $id)
    {
        $user = User::findOrFail($id);

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }

    public function allocateUser(Request $request){
      
      $allocation = new Allocation();
      $allocation->builder_id = $request->input('builder_id');
      $allocation->job_id = $request->input('job_id');
      $allocation->labour_id = Auth::user()->id;
      $allocation->alloc_init = $request->input('job_init');
      $allocation->alloc_end = $request->input('job_end');
      $allocation->alloc_address = $request->input('job_address');
      $allocation->alloc_status = 'new';
      $allocation->ip_address = $_SERVER['REMOTE_ADDR'];

      try {
        $allocation->save();
        
        $user = Auth::user();
        $builder = Admin::where('id',$request->input('builder_id'))->firstOrFail();
        
        $params = array(
          'id'=>$user->id,
          'user'=>$user->firstname,
          'email'=>$user->email,
          'job'=>$request->input('job_name'),
          'allocation'=>$allocation->alloc_id,
          'builder'=>$builder['attributes']
        );
        
        Mail::send('emails.send', $params, function ($m) use ($params) {
          $m->from('nakalissi@gmail.com', 'Hardworking Hire');
          $m->to($params['builder']['email'],$params['builder']['name']);
          $m->subject('Labour allocation request');
        });

        return redirect()->back()->with('message', 'Allocation created!');
      } catch (Exception $e) {
        return view('errors/503', $e);
      }

    }
    
    public function changeStatus($id, $status){

      try {
        $getAllocation = Allocation::where('alloc_id', $id)->first();
        $allocation = $getAllocation['attributes'];
        
        Allocation::where('alloc_id', $allocation['alloc_id'])
          ->update(['alloc_status' => $status]);
        
        $getJob = Job::where('job_id',$allocation['job_id'])->first();
        $job = $getJob['attributes'];

        $takePosition = $job['positions'] - 1;

        Job::where('job_id', $allocation['job_id'])
          ->update(['positions' => $takePosition]);
          
        return redirect('/builder/allocations')->with('message', 'Allocation confirmed!');
      } catch (Exception $e) {
        dump($e);
      }
      
    }

}
