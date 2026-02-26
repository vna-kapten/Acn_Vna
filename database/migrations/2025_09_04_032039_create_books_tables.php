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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('book_id')->primary(); // PK UUID
            $table->string('title');
            $table->string('isbn')->unique();
            $table->uuid('author_id');
            $table->uuid('publisher_id');
            $table->uuid('category_id');
            $table->uuid('shelf_id');
            $table->year('year');
            $table->text('description');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
