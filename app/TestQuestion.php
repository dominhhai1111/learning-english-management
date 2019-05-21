<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    public $timestamps = true;
    protected $table = 'test_question';
    protected $fillable = ['question_id', 'test_id', 'created_ad', 'updated_at'];
}
