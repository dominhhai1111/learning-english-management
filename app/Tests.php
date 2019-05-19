<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    protected $table = 'tests';

    public function getTestLists() {
        $tests = $this->join('parts', 'tests.part_id', '=', 'parts.id')
            ->select('tests.*', 'parts.name as topic_name')
            ->get()
            ->toArray();

        return $tests;
    }
    
    public function getTestById($id) {
        $test = $this->join('parts', 'tests.part_id', '=', 'parts.id')
            ->select('tests.*', 'parts.name as topic_name')
            ->where(['tests.id' => $id])
            ->get()
            ->first()
            ->toArray();

        return $test;
    }
}
