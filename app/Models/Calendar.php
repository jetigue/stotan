<?php

namespace App\Models;

use App\Models\Training\Runs\SteadyRun;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'calendar';

    protected $casts = [
        'calendar_date' => 'date'
    ];


}
