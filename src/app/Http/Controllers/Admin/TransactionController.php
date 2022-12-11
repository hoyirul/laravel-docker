<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class TransactionController extends Controller
{
    public function index(){
        $title = 'Transactions';
        $orders = Order::with('customer')->get();
        return view('admin.transactions.index', compact('orders', 'title'));
    }

    public function detail($id){
        $title = 'Transaction Details';
        $orders = Order::where('id', $id)->first();
        $order_details = OrderDetail::with('book')
                    ->with('order')
                    ->where('order_id', $id)->get();
        $total = OrderDetail::where('order_id', $id)->sum('subtotal');
        return view('admin.transactions.detail', compact('order_details', 'total', 'orders', 'title'));
    }

    public function status($id){
        Order::where('id', $id)->update([
            'admin_id' => auth()->user()->id,
            'status' => 'paid'
        ]);

        return redirect('/u/transaction')->with('success', "Data berhasil diubah pada ". Carbon::now());
    }

    public function report(){
        $orders = Order::with('admin')
                    ->with('customer')
                    ->get();
        // return view('admin.transactions.report', compact('order_details', 'total', 'orders'));
        $pdf = PDF::loadview('admin.transactions.report', [
            'orders' => $orders
        ]);
        return $pdf->stream();
    }
}
