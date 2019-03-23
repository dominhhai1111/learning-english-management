<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/3/2019
 * Time: 11:14 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    public $timestamps = true;
    protected $table = 'questions';
    protected $fillable = ['created_ad', 'updated_at'];

    public function getQuestionList() {
        $questions = $this->join('topics', 'questions.topic_id', '=', 'topics.id')
            ->select('questions.*', 'topics.name as topic_name')
            ->where(['parent_id' => 0])
            ->get()
            ->toArray();

        return $questions;
    }
}