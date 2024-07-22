<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'primary',
        'primary_variant',
        'secondary',
        'secondary_variant',
        'accent',
        'accent_variant',
        'background',
        'background_variant',
    ];
}
