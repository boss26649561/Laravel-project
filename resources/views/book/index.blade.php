@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Book List
                <form action="search" method="POST" role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" class="form-control" name="q"
                                placeholder="Search Books"> <span class="input-group-btn">
                                <button type="submit">Search</button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                @guest
                                @elseif (Auth::user()->status =='Approved')
                                    <th scope="col"><a href="{{ route('book.create') }}"><button type="button" class="btn btn-success">Add a book</button></a></th>
                                @elseif (Auth::user()->status =='Waiting for approval')
                                    <p> You cannot add books until you are approved </p>
                                @endguest
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>
                                    <a href="{{ route('book.show', $book) }}"><button type="button" class="btn btn-primary">Details</button></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
