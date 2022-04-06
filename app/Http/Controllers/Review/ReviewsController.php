<?php

namespace App\Http\Controllers\Review;

use App\Book;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class ReviewsController extends Controller
{
   
    public function create($bookid)
    {
        return view('review.create')->with('bookid',$bookid);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $rules= [
            'review' => ['required','max:499','min:5'],
            'rating' => ['required','integer','between:1,5'],
            'book_id' => [Rule::unique('reviews')->where(function ($query) {
                return $query->where('user_id', Auth::id());
        })]];
        $customMessage = [
                'unique' => 'You have already made an review for this book'
        ];
        $this->validate($request,$rules,$customMessage);
         
        $review = new Review();
        $review->text = $request->review;
        $review->rating = $request->rating;
        $review->user_id = Auth::id();
        $review->book_id = $request->book_id;
        $review->save();
   
        return redirect()->route('book.show', ['book' => $request->book_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    
    public function edit(Review $review)
    {
        return view('review.edit')->with('review',$review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'review' => ['required','max:499','min:5'],
            'rating' => ['required','integer','between:1,5']
        ]);
        $review = Review::find($id);
        $review->text = $request->review;
        $review->rating = $request->rating;
        $review->save();
        return redirect()->route('book.show', ['book' => $review->book_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
   
}
