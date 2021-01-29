<?php

namespace App\Models\Training\RunTypes;

use Database\Factories\Training\RunTypes\ProgressiveRunTypesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progressive extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'progressive_run_types';

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'description'];

    /**
     * Create a new factory instance for the model.
     *
     * @return ProgressiveRunTypesFactory
     */
    protected static function newFactory()
    {
        return ProgressiveRunTypesFactory::new();
    }
}
