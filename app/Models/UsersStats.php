<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersStats extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'guid',
        'name',
        'score',
        'kills',
        'downs',
        'deaths',
        'suicides',
        'revives',
        'headshots',
        'melee_kills',
        'grenade_kills',
        'total_shots',
        'hits',
        'sacrifices',
    ];
}
