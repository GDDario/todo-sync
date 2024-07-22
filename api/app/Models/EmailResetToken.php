<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailResetToken extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'token',
        'opened',
        'created_at'
    ];
}
