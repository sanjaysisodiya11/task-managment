<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'created_by',
        'assigned_to',
        'assigned_by'
    ];

    // Define relationship to User model
    public function creater(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function assignee(){
        return $this->belongsTo(User::class,'assigned_to');
    }

    public function assigner(){
        return $this->belongsTo(User::class,'assigned_by');
    }
}
