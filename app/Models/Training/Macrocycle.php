<?php

namespace App\Models\Training;

use App\Traits\BelongsToTeam;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Macrocycle extends Model
{
    use HasFactory, BelongsToTeam;

    protected $fillable = ['name', 'begin_date', 'end_date', 'team_id'];

    protected $dates = ['begin_date', 'end_date'];

    protected $appends = ['number_of_weeks'];

    public function getBeginDateForHumansAttribute()
    {
        return $this->begin_date->format('M, d Y');
    }

    public function getEndDateForHumansAttribute()
    {
        return $this->end_date->format('M, d Y');
    }

    public function getNumberOfWeeksAttribute()
    {
        $end = Carbon::parse($this->end_date);

        $begin = Carbon::parse($this->begin_date);

        return $end->diffInWeeks($begin);
    }
}
