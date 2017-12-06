<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'jobs';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'alloc_id', 'builder_id', 'job_name', 'job_description', 'job_init', 'job_end', 
      'job_address', 'positions', 'created_at', 'updated_at', 'ip_address', 'job_status'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'ip_address'
  ];
}
