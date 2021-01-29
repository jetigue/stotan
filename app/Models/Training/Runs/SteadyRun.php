<?php

namespace App\Models\Training\Runs;

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

    /**
     * @var string[]
     */
    protected $fillable = [
        'team_id',
        'mesocycle_id',
        'training_date',
        'steady_run_type_id',
        'duration',
        'duration_unit',
        'training_intensity_id',
        'notes'
    ];
}
