<?php

namespace App\Models\Training;

use App\Traits\BelongsToTeam;
use App\Traits\DateFormatsForTrainingPhases;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingDay extends Model
{
    use HasFactory, BelongsToTeam, DateFormatsForTrainingPhases;

    protected $table = 'training_days';

    protected $fillable = ['training_day', 'mesocycle_id'];

    protected $casts = ['training_day' => 'date'];

    public function mesocycle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Mesocycle::class, 'mesocycle_id');
    }


}
