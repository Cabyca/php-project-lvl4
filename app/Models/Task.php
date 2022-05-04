<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

//    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
//    {
//        return $this->hasOne(User::class, 'id', 'created_by_id');
//    }
//
//    public function userAssigned(): \Illuminate\Database\Eloquent\Relations\HasOne
//    {
//        return $this->hasOne(User::class, 'id', 'assigned_to_id');
//    }

    public function assignedTo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
