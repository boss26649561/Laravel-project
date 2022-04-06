<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'title' =>'The Book of Five Rings',
            'author' => 'Miyamoto Musashi',
            'genre' => 'Martial arts',
            'year' => '1743',
            'image' => 'book_images/book_of_five_rings.jpg'
        ]);

        DB::table('books')->insert([
            'title' =>'Thus spoke Zarathustra',
            'author' => 'Friedrich Nietzsche',
            'genre' => 'Philosophy',
            'year' => '1883',
            'image' => 'book_images/thus-spoke-zarathustra.jpg'
        ]);

        DB::table('books')->insert([
            'title' =>'Tractatus Logico-Philosophicus',
            'author' => 'Ludwig Wittengenstein',
            'genre' => 'Philosophy',
            'year' => '1921',
            'image' => 'book_images/tractatus_logico_philosophicus.jpg'
        ]);
        
    }
}
