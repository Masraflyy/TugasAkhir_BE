<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kopi extends Model
{
    protected $table = 'kopi';
    protected $fillable = [
        'nama',
        'jenis',
        'ukuran_ml',        
        'rasa', 
        'harga', 
        'tersedia',
        'gambar'
    ];
}
