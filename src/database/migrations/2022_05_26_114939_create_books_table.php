<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained();
            $table->foreignId('publisher_id')->constrained();
            $table->foreignId('genre_id')->constrained();
            $table->string('title', 100);
            $table->date('publish_date')->nullable();
            $table->integer('book_pages')->nullable();
            $table->string('description')->nullable();
            $table->double('rating', 8,2);
            $table->double('price');
            $table->string('cover_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
