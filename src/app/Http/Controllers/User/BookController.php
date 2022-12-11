<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Customer;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request){
        if($request->search != null || $request->genre_id){
            $books = Book::with('author')
                        ->with('publisher')
                        ->with('genre')
                        ->where('title', 'like', "%" . $request->search . "%")
                        ->orWhere('genre_id', $request->genre_id)
                        ->get();
        }else{
            $books = Book::with('author')
                    ->with('publisher')
                    ->with('genre')
                    ->get();
        }
        $genres = Genre::all();
        return view('pages.books.index', compact('books', 'genres'));
    }

    public function show($id){
        $books = Book::where('id', $id)->first();
        $customer = Customer::where('user_id', auth()->user()->id)->first();
        return view('pages.books.show', compact('books', 'customer'));
    }
}
