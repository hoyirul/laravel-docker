<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index($id){
        $customer = Customer::where('user_id', $id)->first();
        $carts = Cart::with('book')
                    ->with('customer')    
                    ->where('customer_id', $customer->id)->get();
        $total = Cart::where('customer_id', $customer->id)->sum('subtotal');
        return view('pages.carts.index', compact('carts', 'total'));
    }

    public function store(Request $request, $id){
        $request->validate([
            'qty' => 'required',
        ]);

        Cart::create([
            'customer_id' => $request->customer_id,
            'book_id' => $id,
            'price' => $request->price,
            'qty' => $request->qty,
            'discount' => 0,
            'subtotal' => $request->qty * $request->price,
        ]);

        return redirect('/cart'.'/'.auth()->user()->id.'/show')->with('success', "Anda telah menambahkan keranjang!");
    }

    public static function cart_count($id){
        $customer = Customer::where('user_id', $id)->first();
        $count = Cart::where('customer_id', $customer->id)->count();
        return $count;
    }

    public function edit($id){
        $customer = Customer::where('user_id', auth()->user()->id)->first();
        $carts = Cart::with('book')
                    ->with('customer')
                    ->where('customer_id', $customer->id)
                    ->where('id', $id)->first();
        return view('pages.carts.edit', compact('carts'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'price' => 'required',
            'qty' => 'required',
        ]);

        Cart::where('id', $id)->update([
            'qty' => $request->qty,
            'discount' => 0,
            'subtotal' => $request->qty * $request->price,
        ]);

        return redirect('/cart'.'/'.auth()->user()->id.'/show')->with('success', "Anda telah mengubah item tertentu keranjang!");
    }

    public function destroy($id){
        Cart::where('id', $id)->delete();
        return redirect('/cart'.'/'.auth()->user()->id.'/show')->with('success', "Anda telah menghapus item tertentu keranjang!");
    }

    public function checkout_detail($id){
        $customer = Customer::where('user_id', $id)->first();
        $carts = Cart::with('book')
                    ->with('customer')    
                    ->where('customer_id', $customer->id)->get();
        $total = Cart::where('customer_id', $customer->id)->sum('subtotal');
        return view('pages.checkouts.index', compact('carts', 'total', 'customer'));
    }

    public function checkout(Request $request){
        $request->validate([
            'customer_id' => 'required',
            'total' => 'required',
        ]);

        $order_id = 'INV-'.time();
        // dd($order_id);
        Order::create([
            'id' => $order_id,
            'customer_id' => $request->customer_id,
            'order_date' => Carbon::now(),
            'total' => $request->total,
            'comments' => $request->comments,
            'status' => 'unpaid'
        ]);

        $carts = Cart::with('book')
                    ->where('customer_id', $request->customer_id)
                    ->get();

        foreach($carts as $row){
            OrderDetail::create([
                'order_id' => $order_id,
                'book_id' => $row->book_id,
                'price' => $row->price,
                'qty' => $row->qty,
                'discount' => $row->discount,
                'subtotal' => $row->subtotal
            ]);
        }

        Cart::where('customer_id', $request->customer_id)->delete();

        return redirect('/user/transaction')->with('success', "Terima kasih anda telah order ditoko kami, silahkan konfirmasi pembayaran ke admin, dan cetak struk!");
    }
}
