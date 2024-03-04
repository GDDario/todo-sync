<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'is_collaborative',
        'user_id'
    ];
}
