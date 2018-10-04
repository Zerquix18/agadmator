<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    public $incrementing = false;

    protected $fillable = ['id'];
}
