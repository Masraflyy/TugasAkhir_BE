<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KopiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
        'id'         => $this->id,
        'nama'       => $this->nama,
        'jenis'      => $this->jenis,
        'ukuran_ml'  => $this->ukuran_ml,
        'rasa'       => $this->rasa,
        'harga'      => $this->harga,
        'tersedia'   => $this->tersedia,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        ];
    }
}

//jangan lupa follow ig saya buat yang liat ini yaa @rafly_dhana