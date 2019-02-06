<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MasterCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_code')->insert([
            [
                'code' => '001',
                'name' => 'listening',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],

            [
                'code' => '002',
                'name' => 'writing',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
        ]);
    }
}
