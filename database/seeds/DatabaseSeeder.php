<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(TestsTableSeeder::class);
        $this->call(TreatmentsTableSeeder::class);
        $this->call(VisitsFeesTableSeeder::class);
        DB::table('system_reviews')->insert([
            'name'   => 'Eye',
        ]);
        DB::table('system_reviews')->insert([
            "name" => "Head",
        ]);
        DB::table('system_review_suboptions')->insert([
            "name"     => "Lorem Ipsum",
            'r_id'     => 1,
            'added_by' => 1,
        ]);
    }
}
