<?php

namespace App\Models\Training\Runs;

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
        'team_id',
        'mesocycle_id',
        'training_date',
        'intermittent_run_type_id',
        'number_sets',
        'number_repetitions',
        'duration',
        'training_intensity_id',
        'duration_unit',
        'recovery',
        'recovery_unit',
        'recovery_type',
        'notes'
    ];
}
