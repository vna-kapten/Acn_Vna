<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Author extends Model
{
    use HasFactory;

    // protected $primaryKey = 'author_id';
    // public $incrementing = false;
    // protected $keyType = 'string';

    // protected $fillable = [
    //     'author_id',
    //     'author_name',
    //     'author_description',
    // ];

    protected $primaryKey = 'author_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['author_name', 'author_description'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->author_id) {
                $model->author_id = (string) Str::uuid();
            }
   });
}
}