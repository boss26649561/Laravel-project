@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Search</div>
                
                <div class="card-body">
                    @if(isset($details))
                    <p> The Search results for your query <b> {{ $query }} </b> are :</p>
                    <table class="table">
                        <thead>
                            <tr>
                                
                                    
                                
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $book)
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
                    @else
                        <p>No Details found. Try to search again !<p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
