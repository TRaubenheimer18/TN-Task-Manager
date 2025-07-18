<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'title',
        'description',
        'category',
        'priority',
        'deadline',
        'assigned_to',
        'user_id',  
        'status',
    ];

    public function assignedUser()
{
    return $this->belongsTo(User::class, 'assigned_to');
}

}
