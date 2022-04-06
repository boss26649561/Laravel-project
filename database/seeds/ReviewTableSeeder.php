<?php

use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'book_id' =>'1',
            'user_id' => '3',
            'text' => 'Book of five rings was an interesting read',
            'rating' => '5',
        ]);

        DB::table('reviews')->insert([
            'book_id' =>'1',
            'user_id' => '4',
            'text' => 'Book of five rings was an interesting read',
            'rating' => '5',
        ]);
        DB::table('reviews')->insert([
            'book_id' =>'2',
            'user_id' => '4',
            'text' => 'Too confusing',
            'rating' => '2',
        ]);
        DB::table('reviews')->insert([
            'book_id' =>'2',
            'user_id' => '3',
            'text' => 'Good food for thought',
            'rating' => '4',
        ]);
        DB::table('reviews')->insert([
            'book_id' =>'2',
            'user_id' => '2',
            'text' => 'very good',
            'rating' => '5',
        ]);
        DB::table('reviews')->insert([
            'book_id' =>'2',
            'user_id' => '5',
            'text' => 'excellent',
            'rating' => '5',
        ]);
        DB::table('reviews')->insert([
            'book_id' =>'2',
            'user_id' => '6',
            'text' => 'amazing book',
            'rating' => '5',
        ]);
        DB::table('reviews')->insert([
            'book_id' =>'2',
            'user_id' => '1',
            'text' => 'amazing book',
            'rating' => '5',
        ]);

    }
}
