<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    // ...

    public function returnBook()
    {
        $returnDate = Carbon::now();
        $lateDays = max(0, $returnDate->diffInDays($this->pickup_date->addDays(7), false));

        // Calculate and apply fines for late return
        $lateFine = $lateDays * 4000;
        $this->update([
            'return_date' => $returnDate,
            'late_fine' => $lateFine,
        ]);

        // If there's a late fine, deduct it from the user's virtual account
        if ($lateFine > 0) {
            $this->user->virtualAccount->decrement('balance', $lateFine);
        }

        // Mark the book as available for order again
        $this->book->update(['is_available' => true]);
    }

    // ...
}