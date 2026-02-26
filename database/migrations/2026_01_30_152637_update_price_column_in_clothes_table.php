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
        // Fix Clothes price column
        Schema::table('clothes', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->change();
        });
        
        // Fix Products table - Add missing columns if they don't exist
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'nama')) {
                $table->string('nama')->after('id');
            }
            if (!Schema::hasColumn('products', 'kategori')) {
                $table->string('kategori')->after('nama');
            }
            if (!Schema::hasColumn('products', 'stok')) {
                $table->integer('stok')->after('kategori');
            }
            if (!Schema::hasColumn('products', 'harga')) {
                $table->bigInteger('harga')->after('stok');
            } else {
                $table->bigInteger('harga')->change();
            }
            if (!Schema::hasColumn('products', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('harga');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clothes', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change();
        });
        
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['nama', 'kategori', 'stok', 'harga', 'deskripsi']);
        });
    }
};
