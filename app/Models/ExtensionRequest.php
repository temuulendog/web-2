<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint; // Make sure to add this import statement
use Illuminate\Support\Facades\Schema;

class ExtensionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'approved',
    ];

    // ...

    public function up()
    {
        Schema::create('extension_requests', function (Blueprint $table) { // Make sure to add this import statement
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->boolean('approved')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    // ...
}