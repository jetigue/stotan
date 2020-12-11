<?php

namespace App\Models;

use App\Models\Training\Macrocycle;
use App\Models\Training\Mesocycle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function macrocycles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Macrocycle::class, 'team_id');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function mesocycles(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Mesocycle::class,Macrocycle::class, 'team_id', 'macrocycle_id');
    }
}
