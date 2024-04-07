<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'capacidad',
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
