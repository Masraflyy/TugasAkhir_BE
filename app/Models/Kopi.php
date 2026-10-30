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

//jangan lupa follow ig saya buat yang liat ini yaa @rafly_dhana