<?php

namespace App\Models\Training\RunTypes;

use App\Models\Training\Runs\IntermittentRun;
use Database\Factories\Training\RunTypes\IntermittentRunTypesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intermittent extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'intermittent_run_types';

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'description'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return IntermittentRunTypesFactory::new();
    }

    public function intermittentRuns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(IntermittentRun::class);
    }
}
