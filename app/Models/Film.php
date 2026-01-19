<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     * (opsional, tapi bagus untuk kejelasan)
     */
    protected $table = 'films';

    /**
     * Kolom yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'title',
        'poster',
        'rating',
        'trailer',
    ];
}
