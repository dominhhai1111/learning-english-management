<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert(
            [
                'topic_id'          => 1,
                'level'             => 1,
                'question'          => 'Ha Noi is the capital of ...',
                'answers'           => json_encode(['A' => 'ThaiLand', 'B' => 'VietNam', 'USA', 'China']),
                'correct_answer'    => 'B',
                'created_at'        => new DateTime(),
                'updated_at'        => new DateTime()
            ]
        );
    }
}
