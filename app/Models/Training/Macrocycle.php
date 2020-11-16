<?php

namespace App\Models\Training;

use App\Traits\BelongsToTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Macrocycle extends Model
{
    use HasFactory, BelongsToTeam;
}
