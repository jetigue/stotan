<?php

namespace App\Models\Training\Runs;

use App\Models\Training\Intensity;
use App\Models\Training\Mesocycle;
use App\Models\Training\RunTypes\Steady;
use App\Models\Training\TrainingDay;
use App\Traits\BelongsToTeam;
use App\Traits\SteadyRunStats;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SteadyRun extends Model
{
    use HasFactory, BelongsToTeam, SteadyRunStats;

    /**
     * @var string
     */
    protected $table = 'steady_runs';

    protected $casts = ['training_date' => 'date'];

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


}
