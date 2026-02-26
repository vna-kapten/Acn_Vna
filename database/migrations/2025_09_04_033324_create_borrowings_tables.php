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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->uuid('borrowing_id')->primary();
            $table->uuid('borrowing_user_id');
            $table->boolean('borrowing_isreturned')->default(false);
            $table->text('borrowing_notes')->nullable();
            $table->integer('borrowing_fine')->nullable();
            $table->timestamps();

            // Foreign key ke users (opsional, jika users table ada)
            $table->foreign('borrowing_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
