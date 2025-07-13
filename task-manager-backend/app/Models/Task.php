<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Allows mass assignment of these fields
    protected $fillable = [
        'title',
        'status',
        'deadline',
        'user_id',
    ];

    // Define relationship: Task belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
