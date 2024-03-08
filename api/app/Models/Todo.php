<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'todo_list_id',
        'title',
        'description',
        'due_date',
        'is_urgent',
        'schedule_options',
        'is_completed',
        'todo_group_id',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'todo_tag');
    }

    public function group(): BelongsTo {
        return $this->belongsTo(TodoGroup::class, 'todo_groups');
    }
}
