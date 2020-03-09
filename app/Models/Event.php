<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{

    use SoftDeletes;
    
    protected $table = 'events';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'description',
        'place'
    ];

    protected $casts = [
        'sections' => 'array'
    ];
}
