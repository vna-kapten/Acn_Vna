<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    protected $fillable = ['shelf_id', 'shelf_name', 'shelf_description'];

    public $timestamps = false; // kalau tidak pakai created_at/updated_at
}
