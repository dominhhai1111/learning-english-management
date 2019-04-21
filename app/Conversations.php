<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    public $timestamps = true;
    protected $table = 'chat';
    protected $fillable = ['user_id', 'status', 'created_ad', 'updated_at'];
}
