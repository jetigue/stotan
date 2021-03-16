<?php

namespace App\Models\Training\Runs;

use App\Models\Training\Intensity;
use App\Models\Training\Mesocycle;
use App\Models\Training\RunTypes\Intermittent;
use App\Models\Training\TrainingDay;
use App\Traits\BelongsToTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntermittentRun extends Model
{
    use HasFactory, BelongsToTeam;

    /**
     * @var string
     */
    protected $table = 'intermittent_runs';

    /**
     * @var string[]
     */
    protected $fillable = [
        'duration',
        'duration_unit',
        'intermittent_run_type_id',
        'mesocycle_id',
        'notes',
        'number_repetitions',
        'number_sets',
        'recovery',
        'recovery_type',
        'recovery_unit',
        'set_recovery',
        'set_recovery_type',
        'set_recovery_unit',
        'team_id',
        'training_day_id',
        'training_intensity_id',
        'training_session',
    ];

    public function intensity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Intensity::class, 'training_intensity_id');
    }

    public function runType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Intermittent::class, 'intermittent_run_type_id');
    }

    public function mesocycle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Mesocycle::class, 'mesocycle_id');
    }

    public function trainingDay(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TrainingDay::class, 'training_day_id');
    }
}
