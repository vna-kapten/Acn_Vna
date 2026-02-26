<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $primaryKey = 'borrowing_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'borrowing_id',
        'borrowing_user_id',
        'borrowing_isreturned',
        'borrowing_notes',
        'borrowing_fine',
    ];

    protected $casts = [
        'borrowing_isreturned' => 'boolean',
        'borrowing_fine' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'borrowing_user_id', 'id');
    }

    public function borrowingDetails()
    {
        return $this->hasMany(BorrowingDetail::class, 'detail_borrowing_id', 'borrowing_id');
    }
}
