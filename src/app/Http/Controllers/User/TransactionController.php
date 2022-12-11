<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use PDF;

class TransactionController extends Controller
{
    public function transaction(){
        $customer = Customer::where('user_id', auth()->user()->id)->first();
        $orders = Order::where('customer_id', $customer->id)->get();
        return view('pages.transactions.index', compact('orders'));
    }

    public function transaction_detail($id){
        $orders = Order::where('id', $id)->first();
        $order_details = OrderDetail::with('book')
                    ->with('order')
                    ->where('order_id', $id)->get();
        $total = OrderDetail::where('order_id', $id)->sum('subtotal');
        return view('pages.transactions.detail', compact('order_details', 'total', 'orders'));
    }

    public function transaction_print($id){
        $orders = Order::where('id', $id)->first();
        $order_details = OrderDetail::with('book')
                    ->with('order')
                    ->where('order_id', $id)->get();
        $total = OrderDetail::where('order_id', $id)->sum('subtotal');
        // return view('pages.transactions.invoice', compact('order_details', 'total', 'orders'));
        $pdf = PDF::loadview('pages.transactions.invoice', [
            'order_details' => $order_details, 
            'total' => $total, 
            'orders' => $orders
        ]);
        return $pdf->stream();
    }
}
