<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'guid',
        'name',
    ];
}
