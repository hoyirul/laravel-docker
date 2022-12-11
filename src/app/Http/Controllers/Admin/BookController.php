<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Storage\StorageClient;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Books';
        $books = Book::with('author')
                    ->with('publisher')
                    ->with('genre')
                    ->get();
        return view('admin.books.index', compact('books', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Books';
        $authors = Author::all();
        $publishers = Publisher::all();
        $genres = Genre::all();
        return view('admin.books.create', [
            'title' => $title,
            'authors' => $authors,
            'publishers' => $publishers,
            'genres' => $genres,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // ddd($request->all());
        $request->validate([
            'author_id' => 'required',
            'publisher_id' => 'required',
            'genre_id' => 'required',
            'title' => 'required|string|max:255',
            'publish_date' => 'required',
            'book_pages' => 'required',
            'description' => 'required|string',
            'rating' => 'required',
            'price' => 'required',
            'cover_image' => 'required',
        ]);

        if($request->file('cover_image')){
            $cover_image = $request->file('cover_image')->store('book', 'public');
        }

        $googleConfigFile = file_get_contents(env('GOOGLE_APPLICATION_CREDENTIALS'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);

        $storageBucketName = config('googlecloud.storage_bucket');
        $bucket = $storage->bucket($storageBucketName);
        $fileSource = $cover_image;
        $googleCloudStoragePath = $cover_image;
        /* Upload a file to the bucket.
        Using Predefined ACLs to manage object permissions, you may
        upload a file and give read access to anyone with the URL.*/
        $bucket->upload($fileSource, [
        // 'predefinedAcl' => 'publicRead',
            'name' => $googleCloudStoragePath
        ]);

        Book::create([
            'author_id' => $request->author_id,
            'publisher_id' => $request->publisher_id,
            'genre_id' => $request->genre_id,
            'title' => $request->title,
            'publish_date' => $request->publish_date,
            'book_pages' => $request->book_pages,
            'description' => $request->description,
            'rating' => $request->rating,
            'price' => $request->price,
            'cover_image' => $cover_image,
            'url_cloud' => 'https://storage.cloud.google.com/'.$storageBucketName.'/'.$googleCloudStoragePath
        ]);
        
        return redirect('/u/book')->with('success', "Data berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Books';
        $books = Book::where('id', $id)->first();
        return view('admin.books.show', compact('title', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Books';
        $authors = Author::all();
        $publishers = Publisher::all();
        $genres = Genre::all();
        $books = Book::where('id', $id)->first();
        return view('admin.books.edit', compact('title', 'books', 'authors', 'publishers', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::where('id', $id)->first();
        // dd($book->cover_image);
        $request->validate([
            'author_id' => 'required',
            'publisher_id' => 'required',
            'genre_id' => 'required',
            'title' => 'required|string|max:255',
            'publish_date' => 'required',
            'book_pages' => 'required',
            'description' => 'required|string',
            'rating' => 'required',
            'price' => 'required',
            'cover_image' => 'required',
        ]);

        if($book->cover_image && file_exists(storage_path('app/public/'. $book->cover_image))){
            Storage::delete(['public/', $book->cover_image]);
        }

        $cover_image = null;

        if($request->cover_image != null){
            $cover_image = $request->file('cover_image')->store('book', 'public');
        }

        Book::where('id', $id)->update([
            'author_id' => $request->author_id,
            'publisher_id' => $request->publisher_id,
            'genre_id' => $request->genre_id,
            'title' => $request->title,
            'publish_date' => $request->publish_date,
            'book_pages' => $request->book_pages,
            'description' => $request->description,
            'rating' => $request->rating,
            'price' => $request->price,
            'cover_image' => $cover_image
        ]);
        
        return redirect('/u/book')->with('success', "Data berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::where('id', $id)->delete();
        return redirect('/u/book')->with('success', "Data berhasil dihapus");
    }
}
