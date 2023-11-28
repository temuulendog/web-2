@extends('layouts.app')

@section('content')
    <h1>Create a New Book</h1>

    <!-- Add your form here -->
    <form action="{{ route('books.store') }}" method="post">
        @csrf
        <!-- Add your form fields here -->
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <!-- Add more form fields as needed -->

        <button type="submit">Create Book</button>
    </form>
@endsection