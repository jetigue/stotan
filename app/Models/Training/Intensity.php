<?php

namespace App\Models\Training;

use App\Models\Training\Runs\IntermittentRun;
use App\Models\Training\Runs\ProgressiveRun;
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

    public function intermittentRuns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(IntermittentRun::class, 'id', 'training_intensity_id');
    }

    public function progressiveRuns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProgressiveRun::class, 'id', 'training_intensity_id');
    }

    public function getJdPointsAttribute($value)
    {
        return $value/1000;
    }

    public function getInitialsAttribute(): string
    {
        $words = explode(" ", $this->name);
        $initials = "";

        foreach ($words as $w)
        {
            $initials .= $w[0];
        }

        return $initials;
    }

}
