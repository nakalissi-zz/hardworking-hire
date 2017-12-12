<?php

namespace App\Http\Controllers;

// Models
use App\User;
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
        $role = Auth::user();
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
      $allocation->builder_id = $request->input('firstname');
      $allocation->labour_id = Auth::user()->id;
      $allocation->alloc_init = $request->input('date_init');
      $allocation->alloc_end = $request->input('date_end');
      $allocation->alloc_address = $request->input('job_address');
      $allocation->alloc_status = 'new';
      $allocation->ip_address = $_SERVER['REMOTE_ADDR'];

      var_dump($allocation);
      try {
        $allocation->save();

        $user = Auth::user();
        $params = array('user'=>$user->firstname);
        dump($params);
        // $user = User::findOrFail($id);
        $user = User::findOrFail(1)->toArray();
        dump($user);
        Mail::send('emails.send', $params, function ($message) {
          $message->from('nakalissi@gmail.com');
          $message->sender('nakalissi@gmail.com');
          $message->to('nakalissi@gmail.com');
          $message->subject('Labour allocated!');
          $message->priority($level = 1);
        });

        return redirect('/labour/allocations')->with('status', 'Job created!');
      } catch (Exception $e) {
        var_dump($e);
        return view('errors/503', $e);
      }

      // if (isset($array)) {
      //   try {
      //     DB::table('allocations')->insertGetId($array);
      //     DB::table('users')->where('id',$input['user_id'])
      //       ->update(['status' => 'allocated', 'date_updated' => date('Y-m-d H:i:s')]);
      //     DB::commit();
      //     $response = 'User included successfully!';
      //     return redirect(route('labour.allocations'));
      //
      //   } catch (Exception $e) {
      //     DB::rollback();
      //     return view('errors/503', $e);
      //   }
      // }

    }

}
