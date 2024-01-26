<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'team_id',
        'creator_user_id',
        'title',
        'description',
        'due_date',
        'scheduled'
    ];
}
