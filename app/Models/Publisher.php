<?php

namespace App\Models;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = ['publisher_id', 'publisher_name', 'publisher_address'];
}
