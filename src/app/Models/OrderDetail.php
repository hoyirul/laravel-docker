<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'book_id',
        'price',
        'qty',
        'discount',
        'subtotal',
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function book(){
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function order_detail(){
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}
