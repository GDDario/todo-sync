<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'description',
        'due_date',
        'scheduled'
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'todo_tag');
    }
}
