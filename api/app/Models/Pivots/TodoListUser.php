<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;

class TodoListUser extends Model
{
    use HasFactory, AsPivot;

    protected $fillable = [
        'uuid',
        'todo_list_id',
        'user_id'
    ];
}
