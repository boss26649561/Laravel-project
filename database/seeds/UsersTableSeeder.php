<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

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
            'name' =>'Admin',
            'email' => 'admin@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Administrator',
            'status' => 'N/A'
        ]);

        DB::table('users')->insert([
            'name' =>'Chris',
            'email' => 'chris@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Curator',
            'status' => 'Approved'
        ]);

        DB::table('users')->insert([
            'name' =>'Chloe',
            'email' => 'Chloe@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Curator',
            'status' => 'Waiting for approval'
        ]);

        DB::table('users')->insert([
            'name' =>'Cara',
            'email' => 'Cara@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Curator',
            'status' => 'Waiting for approval'
        ]);
       
        DB::table('users')->insert([
            'name' =>'Bob',
            'email' => 'Bob@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Member',
            'status' => 'N/A'
        ]);

        DB::table('users')->insert([
            'name' =>'Fred',
            'email' => 'Fred@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Member',
            'status' => 'N/A'
        ]);
       
    }
}
