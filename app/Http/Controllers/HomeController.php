<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Job;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $jobs = Job::
      where('jobs.job_status', '!=', 'canceled')
      ->leftJoin('admins', 'admins.id', '=', 'jobs.builder_id')
      ->orderBy('jobs.created_at', 'desc')
      ->get();

      return view('home', ['jobs' => $jobs]);
    }

}
