<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MergeTestQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('merge_test_question')->insert(
            [
                'test_id' => 1,
                'question_id' => 1,
                'display_order' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        );
    }
}
