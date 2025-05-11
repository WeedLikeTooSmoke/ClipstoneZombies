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
    ];
}
