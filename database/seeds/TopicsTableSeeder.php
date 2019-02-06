<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            [
                'key' => 'photographs',
                'name' => 'Photographs',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'key' => 'question_response',
                'name' => 'Question - Response',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'key' => 'short_conversations',
                'name' => 'Short conversations',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'key' => 'short_talks',
                'name' => 'Short talks',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'key' => 'incomplete_sentences',
                'name' => 'Incomplete sentences',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'key' => 'text_completion',
                'name' => 'Text completion',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'key' => 'reading_comprehension',
                'name' => 'Reading Comprehension',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ]);
    }
}
