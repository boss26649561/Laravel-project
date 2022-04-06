<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Book;
use Illuminate\Support\Facades\Input;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/documentation', function () {
    return view('book.documentation');
});

Route::get('/', function () {
    $books = Book::all();
    return view('book.index')->with('books',$books);
});
//search function
Route::any('/search',function(){
    $q = Request::get ( 'q' );
    $book = Book::where('title','LIKE','%'.$q.'%')->orWhere('author','LIKE','%'.$q.'%')->orWhere('genre','LIKE','%'.$q.'%')->orWhere('year','LIKE','%'.$q.'%')->get();
    if(count($book) > 0)
        return view('book.search')->withDetails($book)->withQuery ( $q );
    else return view ('book.search');
});
//
//highest rated search
Route::get('/rated',function(){
    //calcuate the average rating of each book, rearrange then send the query to the page 
    //use distinct to find how many unique books
    $price = DB::table('reviews')
                //->where('book_id', 1)
                ->avg('rating');
                //->having('book_id'>2);
    dd($price);
    
    return view('book.toprated')->with('books',$query);
});



Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
//custom admin controllers
Route::get('/admin','Admin\UsersController@index')->name('admin.index');
Route::get('/admin/{id}','Admin\UsersController@edit')->name('admin.edit');

//book controller
Route::namespace('Book')->group(function(){
    Route::resource('/book', 'BooksController');
});
//review controller
Route::get('/review/{book_id}','Review\ReviewsController@create')->name('review.create');
Route::namespace('Review')->group(function(){
    Route::resource('/review', 'ReviewsController', ['only' => ['store','edit','update']]);
});
