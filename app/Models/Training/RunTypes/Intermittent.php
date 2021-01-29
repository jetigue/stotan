<?php

namespace App\Models\Training\RunTypes;

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
}
