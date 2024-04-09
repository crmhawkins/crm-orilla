<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dia extends Model
{
    use HasFactory;

    protected $fillable = [
        'inicio',
        'fin',
    ];

    /**
     * Mutaciones de fecha.
     *
     * @var array
     */

    protected $dates = [
        'created_at', 'updated_at',
    ];
}
