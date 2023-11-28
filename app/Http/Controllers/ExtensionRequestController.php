<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ExtensionRequest;


class ExtensionRequestController extends Controller
{
    public function requestExtension($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Additional logic to check if the user is eligible for an extension

        ExtensionRequest::create(['order_id' => $order->id]);

        return redirect()->route('dashboard')->with('success', 'Extension request sent.');
    }
}
