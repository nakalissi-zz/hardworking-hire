<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Job;

class JobsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $jobs = DB::table('jobs')
      ->leftJoin('admins', 'admins.builder_id', '=', 'jobs.builder_id')
      ->get();
      return view('jobs/all', ['jobs' => $jobs]);
    }

    public function add(){
      $getCompanies = DB::table('admins')->get();
      return view('/jobs/jobform', [
        'builders' => $getCompanies
      ]);
    }

    public function addjob($job = ''){
      if (isset($job)) {

        $input = Input::all();

        $job = new Job();
        $job->builder_id = $input['builder_id'];
        $job->job_name = $input['job_name'];
        $job->job_description = $input['job_description'];
        $job->job_init = $input['date_init'];
        $job->job_end = $input['date_end'];
        $job->job_address = $input['job_address'];
        $job->positions = $input['job_positions'];
        $job->job_status = 'new';
        $job->ip_address = $_SERVER['REMOTE_ADDR'];

        if (isset($job)) {
          $job->save();

          return redirect('/builder/jobs')->with('message', 'Job included successfully!');

        } else {
          return redirect('/jobs/add')->with('message', 'Login Failed');
        }

      }
    }

    public function allocJobView($job_id = ''){ // All available jobs

      if(!empty($job_id)){
        $getJobByID = DB::table('jobs')->where('job_id',$job_id)->get();
      }
      $getUsers = DB::table('users')
        ->where('status','available')
        ->get();
      $getCompanies = DB::table('admins')->get();
      return view('/jobs/alloc-job-view', [
        'job' => $getJobByID,
        'users' => $getUsers,
        'builder' => $getCompanies,
      ]);
    }

    public function jobDel($job_id = ''){ // Job Description
      if(!empty($job_id)){
        DB::table('jobs')->where('job_id',$job_id)->delete();
      }
      return redirect('/builder/jobs')->with('message', 'Job delete successfully!');
    }

}
