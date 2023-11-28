<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

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
}