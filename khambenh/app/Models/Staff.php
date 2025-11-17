<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    // Chỉ rõ tên bảng trong DB
    protected $table = 'staffs';

    protected $fillable = [
        'user_id',
        'phone',
        'position',
        'date_of_birth',
        'gender',
        'address',
        'hometown',
        'notes',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
