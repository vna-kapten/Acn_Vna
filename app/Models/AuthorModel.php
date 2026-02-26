<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorModel extends Model
{
    use HasFactory;
    protected $table = 'authors';
protected $primaryKey = 'author_id';
protected $fillable = array(
'author_id',
'author_name',
'author_description',
'created_at',
'updated_at'
);
protected $casts = array(
'author_id' => 'string',
);
}
