<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    public $timestamps = true;
    protected $table = 'user_test';
    protected $fillable = ['user_id', 'test_id', 'score', 'time', 'created_ad', 'updated_at'];
}
