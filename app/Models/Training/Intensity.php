<?php

namespace App\Models\Training;

use App\Models\Training\Runs\SteadyRun;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intensity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'training_intensities';

    /**
     * Fillable fields for an athlete.
     *
     *@var array
     */
    protected $fillable = [
        'name',
        'percentVO2Max',
        'percentMaxHR',
        'jd_points',
        'description',
        'purpose'
    ];

    public function steadyRuns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SteadyRun::class, 'id', 'training_intensity_id');
    }
}
