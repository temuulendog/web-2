<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Book;

class BookController extends Controller
{

    
    public function markAsRented($orderId)
    {
        // Logic to mark the book as rented
        $order = Order::findOrFail($orderId);
        $order->book->update(['is_rented' => true]); // Assuming you have an 'is_rented' field in your books table

        // Additional logic for sending notifications, etc.
        

        return redirect()->route('dashboard')->with('success', 'Book marked as rented.');
    }

        public function index()
        {
            $books = Book::paginate(10); // Adjust the number as needed
        
            return view('books.index', compact('books'));
        }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }
    public function create()
    {
        $genres = ['Fiction', 'Non-Fiction', 'Science Fiction', 'Mystery', 'Romance']; // Replace with data from your database

        return view('books.create', compact('genres'));
    }



    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required|in:Fiction,Non-Fiction,Science Fiction,Mystery,Romance', // Adjust as needed
            'published_year' => 'required|numeric',
            // Add more validation rules as needed
        ]);

        // Create a new book
        Book::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'genre' => $request->input('genre'),
            'published_year' => $request->input('published_year'),
            // Add more fields as needed
        ]);

        // Redirect to the book list with a success message
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    

}