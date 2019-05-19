<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    public $timestamps = true;
    protected $table = 'parts';
    protected $fillable = ['created_ad', 'updated_at'];
}
