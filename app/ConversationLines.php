<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConversationLines extends Model
{
    public $timestamps = true;
    protected $table = 'chat_line';
    protected $fillable = ['chat_id', 'user_id', 'admin_id', 'content', 'created_ad', 'updated_at'];
}
