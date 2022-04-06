<?php

namespace App\Http\Controllers\Book;

use App\Book;
use App\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\FullNameRule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    function __construct(){
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('book.index')->with('books',$books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required','max:255','unique:books,title','regex:/^[\s\w-]*$/'],
            'author' => ['required','max:128',new FullNameRule],
            'genre' =>['required',Rule::in(['Philosophy', 'Martial arts', 'Fiction','Sports','Action','Adventure','Fantasy'])],
            'year' => ['required','numeric','between:1700,2021'],
            'image' => ['required']
            ]);
        $image_store = request()->file('image')->store('public/book_images');
        $newstring = str_replace("public/", "", $image_store);
        //dd($newstring);
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->year = $request->year;
        $book->image = $newstring;
        $book->save();
        return redirect(route('book.index'));    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {   
        //retrieves reviews from the model
        //$reviews = Book::find($book->id)->reviews;
        $reviews = Review::where('book_id', "LIKE", $book->id)->paginate(5);

        
        //check if review for current user is in the database
        $edit = Review::where('book_id', '=', $book->id)->where('user_id', '=', Auth::id())->get(); 
        return view('book.details')->with('book',$book)->with('reviews',$reviews)->with('edit',$edit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('book.edit')->with('book',$book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required','max:255','unique:books,title','regex:/^[\s\w-]*$/'],
            'author' => ['required','max:128',new FullNameRule],
            'genre' =>['required','alpha',Rule::in(['Philosophy', 'Martial arts', 'Fiction','Sports','Action','Adventure'])],
            'year' => ['required','numeric','between:1700,2021']
            ]);
        $book = Book::find($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->year = $request->year;
        $book->save();
        return redirect(route('book.show', $book)); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->destroy($book->id);
        return redirect(route('book.index')); 
    }
}
