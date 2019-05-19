<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/3/2019
 * Time: 11:14 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Questions extends Model
{
    public $timestamps = true;
    protected $table = 'questions';
    protected $fillable = ['created_ad', 'updated_at'];

    public function getQuestionList() {
        $questions = $this->join('parts', 'questions.part_id', '=', 'parts.id')
            ->select('questions.*', 'parts.name as topic_name')
            ->where(['parent_id' => 0])
            ->get()
            ->toArray();

        return $questions;
    }

    public function getQuestionsOfTest($questionIds) {
        if (empty($questionIds)) return NULL;

        $questionIds = \GuzzleHttp\json_decode($questionIds);
        $questions = $this->join('parts', 'questions.part_id', '=', 'parts.id')
                        ->select('questions.*', 'parts.name as topic_name')
                        ->whereIn ('questions.id', $questionIds)
                        ->get()
                        ->toArray();

        return $questions;
    }
    
    public function topic() {
        return $this->belongsTo('parts');
    }
}