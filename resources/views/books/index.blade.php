<!-- resources/views/books/books.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Book List</h1>

    @if(count($books) > 0)
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Published Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->genre }}</td>
                        <td>{{ $book->published_year }}</td>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No books available.</p>
    @endif

    <a href="{{ route('books.create') }}">Add a New Book</a>
@endsection
