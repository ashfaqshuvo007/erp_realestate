<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{

    protected $fillable = [
        'name',
        'email',
        'share',
        'agent_share',
    ];

}
