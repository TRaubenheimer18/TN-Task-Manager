<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Add all columns you want mass assignable here
    protected $fillable = [
        'title',
        'description',
        'category',
        'priority',
        'deadline',
        'assigned_to',
        'user_id',  // Add this line
        'status',   // if you have status and want to mass assign it
    ];

    public function assignedUser()
{
    return $this->belongsTo(User::class, 'assigned_to');
}

}
