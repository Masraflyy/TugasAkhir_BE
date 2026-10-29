<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
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
