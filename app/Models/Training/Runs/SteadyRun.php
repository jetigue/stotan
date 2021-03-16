<?php

namespace App\Models\Training\Runs;

use App\Models\Training\Intensity;
use App\Models\Training\Mesocycle;
use App\Models\Training\RunTypes\Steady;
use App\Models\Training\TrainingDay;
use App\Traits\BelongsToTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SteadyRun extends Model
{
    use HasFactory, BelongsToTeam;

    /**
     * @var string
     */
    protected $table = 'steady_runs';

    protected $casts = ['training_date' => 'date'];

    protected $appends = [
        'minutes_running' => 'float'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'team_id',
        'mesocycle_id',
        'training_day_id',
        'steady_run_type_id',
        'duration',
        'duration_unit',
        'training_intensity_id',
        'training_session',
        'notes'
    ];

    public function mesocycle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Mesocycle::class, 'mesocycle_id');
    }

    public function runType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Steady::class, 'steady_run_type_id');
    }

    public function intensity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Intensity::class, 'training_intensity_id');
    }

    public function trainingDay(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TrainingDay::class, 'training_day_id');
    }

    public function getDurationUnitAttribute($value): string
    {
        if ($value === 'minutes')
        {
            return $this->duration === 1 ? 'minute' : 'minutes';
        }
        elseif ($value === 'meters')
        {
            return $this->duration === 1 ? 'meter' : 'meters';
        }
        else { return $this->duration === 1 ? 'mile' : 'miles'; }
    }

    public function getMinutesRunningAttribute(): float
    {
        if ($this->duration_unit === 'miles')
        {
            switch($this->intensity->name) {
                case 'Easy':
                    $min = $this->duration * 7.133;
                    break;
                case 'Steady State':
                    $min = $this->duration * 6.167;
                    break;
                case 'Threshold':
                    $min = $this->duration * 5.817;
                    break;
                case 'Critical Velocity':
                    $min = $this->duration * 5.6;
                    break;
                case 'Interval':
                    $min = $this->duration * 5.217;
                    break;
            }
            return $min;
        }

        elseif ($this->duration_unit === 'meters')
        {
            switch($this->intensity->name) {
                case 'Easy':
                    $min = $this->duration/1000 * 4.433;
                    break;
                case 'Steady State':
                    $min = $this->duration/1000 * 3.83;
                    break;
                case 'Threshold':
                    $min = $this->duration/1000 * 3.617;
                    break;
                case 'Critical Velocity':
                    $min = $this->duration/1000 * 3.483;
                    break;
                case 'Interval':
                    $min = $this->duration/1000 * 3.267;
                    break;
                case 'Repetition':
                    $min = $this->duration/400 * 1.217;
                    break;
            }
            return $min;
        }

        return $this->duration;

    }

    public function getMilesAttribute()
    {
        if ($this->duration_unit === 'minutes')
        {
            switch($this->intensity->name) {
                case 'Easy':
                    $mi = $this->duration / 7.05;
                    break;
                case 'Steady State':
                    $mi = $this->duration / 6.117;
                    break;
                case 'Threshold':
                    $mi = $this->duration / 5.767;
                    break;
                case 'Critical Velocity':
                    $mi = $this->duration / 5.55;
                    break;
                case 'Interval':
                    $mi = $this->duration / 5.183;
                    break;
                case 'Repetition':
                    $mi = $this->duration / 4.7;
                    break;
            }
            return round($mi, 1) . ' ' . 'mi';
        }
        elseif ($this->duration_unit === 'meters')
        {
            return round($this->duration/1609, 1)  . ' ' . 'mi';
        }
        return $this->duration . ' ' . 'mi';
    }

    public function getPointsAttribute(): string
    {
        $points = round(($this->minutes_running * $this->intensity->jd_points / 1000));

        return $points == 1 ? '1 pt' : $points . ' ' . 'pts';
    }

    public function getDurationInHMAttribute(): string
    {
        $min = $this->minutes_running;

        return $this->timeToString($min);
    }

    /**
     * @param float $min
     * @return string
     */
    public function timeToString(float $min): string
    {
        $hours = floor($min / 60);
        $minutes = $min % 60;

        $hrs = $hours < 1 ? '' : ($hours == 1 ? '1 hr' . ' ' : $hours . ' ' . 'hrs' . ' ');
        $min = $minutes < 1 ? '' : $minutes . ' ' . 'min';

        return $hrs . $min;
    }
}
