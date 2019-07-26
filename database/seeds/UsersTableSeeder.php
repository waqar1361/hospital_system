<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => "Admin",
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
            'date_birth' => '12-12-1999',
            'address' => 'some where in lahore',
            'type' => "admin",
            'salary' => '25000',
            'lic_no' => str_random(4),
            'added_by' => '1'
        ]);
        
        DB::table('users')->insert([
            'first_name' => "Doctor",
            'last_name' => 'User',
            'email' => 'doctor@example.com',
            'password' => bcrypt('secret'),
            'date_birth' => '12-12-1999',
            'address' => 'some where in lahore',
            'type' => "doctor",
            'salary' => '25000',
            'lic_no' => str_random(4),
            'added_by' => '1'
        ]);
        
        DB::table('users')->insert([
            'first_name' => "Nurse",
            'last_name' => 'User',
            'email' => 'nurse@example.com',
            'password' => bcrypt('secret'),
            'date_birth' => '12-12-1999',
            'address' => 'some where in lahore',
            'type' => "nurse",
            'salary' => '25000',
            'lic_no' => str_random(4),
            'added_by' => '1'
        ]);
    }
}
