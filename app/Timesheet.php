<?php

namespace App;

use App\Http\Requests;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'timesheet';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'labour_id', 'builder_id', 'alloc_id', 'date', 'start_time', 'end_time', 'ip_address'
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
