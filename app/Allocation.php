<?php

namespace App;

use App\Http\Requests;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'allocations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'builder_id', 'labour_id', 'alloc_init', 'alloc_end', 'alloc_address', 'alloc_status', 'ip_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ip_address',
    ];
}
