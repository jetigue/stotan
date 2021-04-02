<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function roles()
    {
        $this->belongsToMany(Role::class)->withTimestamps();
    }
}
