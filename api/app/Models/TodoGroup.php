<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TodoGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'user_id',
        'todo_list_id'
    ];

    protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];

    public function todos(): HasMany {
        return $this->hasMany(Todo::class, 'todo_group_id');
    }
}
