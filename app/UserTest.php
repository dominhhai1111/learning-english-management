<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    public $timestamps = true;
    protected $table = 'user_test';
    protected $fillable = ['created_ad', 'updated_at'];
}
