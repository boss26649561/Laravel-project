@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col" >{{$book->title}} </th>
                            @guest
                            @elseif (Auth::user()->status =='Approved')
                                <th scope="col"><a href="{{ route('book.edit', $book) }}"><button type="button" class="btn btn-secondary">Update</button></a></th>
                                <th scope="col">
                                    <form method="POST" action= "{{ route('book.destroy', $book) }}">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </th>
                            @elseif (Auth::user()->status =='Waiting for approval')
                                <p> You cannot update or delete books until you are approved </p>
                            @endguest
                            
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-body">
                    <img src="{{url($book->image)}}" name="bookimage" alt="book image" style="width:180px;height:300px;">
                    <p>Author:{{$book->author}}</p><br>
                    <p>Genre:{{$book->genre}}</p><br>
                    <p>Released:{{$book->year}}</p><br>   
                    <h2>Reviews</h2>
                    @guest


                    @elseif (Auth::user()->type =='Member' or 'Curator')
                        <a href="{{ route('review.create', $book->id)  }}"><button type="button" class="btn btn-success">Add Review</button></a>
                        @if (!$edit->isEmpty())
                                <a href="{{ route('review.edit', $edit[0]->id) }}"><button type="button" class="btn btn-primary">Edit your Review</button></a>
                        @endif
                    
                    @endguest

                    @foreach ($reviews as $review)
                        <h3>{{$review->user->name}}</h3>
                        <p>Last updated:{{$review->updated_at}}</p>
                        <p>{{$review->text}}</p>
                        <p>{{$review->rating}}/5</p>
                        <br>
                    @endforeach
                    {{ $reviews->links() }}
                </div>
        </div>
    </div>
</div>
@endsection
