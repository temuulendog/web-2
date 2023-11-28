<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Book;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function placeOrder($bookId)
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the book based on $bookId
        $book = Book::findOrFail($bookId);

        // Check if the book is available for order
        if (!$book->is_available) {
            return redirect()->route('books.index')->with('error', 'Book is not available for order.');
        }

        // Calculate pickup date (1 day from now)
        $pickupDate = Carbon::now()->addDay();

        // Create an order
        $order = Order::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'pickup_date' => $pickupDate,
            // Add other fields as needed
        ]);
        

        // Deduct 3500 from the user's virtual account balance
        $user->virtualAccount->decrement('balance', 3500);

        // Mark the book as unavailable
        $book->update(['is_available' => false]);

        // Additional logic for sending notifications, etc.

        return redirect()->route('dashboard')->with('success', 'Order placed successfully.');
        
    }
    public function returnBook($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Additional logic to check if the user has already returned the book

        $order->returnBook();

        return redirect()->route('dashboard')->with('success', 'Book returned successfully.');
    }
}