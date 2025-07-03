<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'due_date',
        'status',
        'category'
    ];

    protected $casts = [
    'due_date' => 'date',
    // other fields...
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}