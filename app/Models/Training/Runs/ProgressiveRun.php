<?php

namespace App\Models\Training\Runs;

use App\Models\Training\Intensity;
use App\Models\Training\Mesocycle;
use App\Models\Training\RunTypes\Progressive;
use App\Traits\BelongsToTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressiveRun extends Model
{
    use HasFactory, BelongsToTeam;

    /**
     * @var string
     */
    protected $table = 'progressive_runs';

    /**
     * @var string[]
     */
    protected $fillable = [
        'duration',
        'duration_unit',
        'final_training_intensity_id',
        'mesocycle_id',
        'notes',
        'progression_interval',
        'progression_interval_unit',
        'progressive_run_type_id',
        'starting_training_intensity_id',
        'team_id',
        'training_date',
        'training_session',
    ];

    public function startingIntensity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Intensity::class, 'starting_training_intensity_id');
    }

    public function finalIntensity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Intensity::class, 'final_training_intensity_id');
    }

    public function runType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Progressive::class, 'progressive_run_type_id');
    }

    public function mesocycle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Mesocycle::class, 'mesocycle_id');
    }
}
