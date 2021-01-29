<?php

namespace App\Models\Training\RunTypes;

use Database\Factories\Training\RunTypes\SteadyRunTypesFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Steady extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'steady_run_types';

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'description'];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return SteadyRunTypesFactory::new();
    }
}
