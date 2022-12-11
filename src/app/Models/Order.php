<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'customer_id',
        'admin_id',
        'order_date',
        'total',
        'comments',
        'status',
    ];

    public $incrementing = false;

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
