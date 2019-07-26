<?php

use Illuminate\Database\Seeder;

class VisitsFeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visits_fees')->insert([
            "type" => "initial_encounter",
            "fee" => "5000"
        ]);
        DB::table('visits_fees')->insert([
            "type" => "follow_up",
            "fee" => "4000"
        ]);
        DB::table('visits_fees')->insert([
            "type" => "routine",
            "fee" => "3000"
        ]);
    }
}
