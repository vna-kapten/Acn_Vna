<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel: shelves
        Schema::create('shelves', function (Blueprint $table) {
            $table->uuid('shelf_id')->primary();
            $table->string('shelf_name', 150);
            $table->string('shelf_position', 25);
        });

        // Tabel: publishers
        Schema::create('publishers', function (Blueprint $table) {
            $table->uuid('publisher_id')->primary();
            $table->string('publisher_name', 150);
            $table->string('publisher_description', 255)->nullable();
        });

        // Tabel: categories
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('category_id')->primary();
            $table->string('category_name', 150);
            $table->string('category_description', 255)->nullable();
        });

        // Tabel: users
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('firstname', 75);
            $table->string('lastname', 75);
            $table->string('username', 75);
            $table->string('email', 150)->unique();
            $table->string('password', 150);
            $table->boolean('isadmin')->default(false);
            $table->timestamps();
        });

        // Tabel: books
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('book_id')->primary();
            $table->uuid('book_category_id');
            $table->uuid('book_publisher_id');
            $table->uuid('book_shelf_id');
            $table->uuid('book_author_id'); // foreign key ke tabel authors
            $table->string('book_name', 255);
            $table->char('book_isbn', 13);
            $table->integer('book_stock');
            $table->string('book_description', 255);
            $table->string('book_img', 255);
            $table->timestamps();

            // Relasi (foreign keys)
            $table->foreign('book_category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('book_publisher_id')->references('publisher_id')->on('publishers')->onDelete('cascade');
            $table->foreign('book_shelf_id')->references('shelf_id')->on('shelves')->onDelete('cascade');
            $table->foreign('book_author_id')->references('author_id')->on('authors')->onDelete('cascade');
        });

        // Tabel: borrowings
        Schema::create('borrowings', function (Blueprint $table) {
            $table->uuid('borrowing_id')->primary();
            $table->uuid('borrowing_user_id');
            $table->boolean('borrowing_isreturned')->default(false);
            $table->text('borrowing_notes')->nullable();
            $table->integer('borrowing_fine')->nullable();
            $table->timestamps();

            $table->foreign('borrowing_user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Tabel: borrowing_details
        Schema::create('borrowing_details', function (Blueprint $table) {
            $table->uuid('detail_id')->primary();
            $table->uuid('detail_book_id');
            $table->uuid('detail_borrowing_id');
            $table->integer('detail_quantity');
            $table->timestamps();

            $table->foreign('detail_book_id')->references('book_id')->on('books')->onDelete('cascade');
            $table->foreign('detail_borrowing_id')->references('borrowing_id')->on('borrowings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_details');
        Schema::dropIfExists('borrowings');
        Schema::dropIfExists('books');
        Schema::dropIfExists('users');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('publishers');
        Schema::dropIfExists('shelves');
        // authors tidak dihapus karena sudah dibuat sebelumnya
    }
};
