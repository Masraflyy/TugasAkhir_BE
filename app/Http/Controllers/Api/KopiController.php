<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KopiResource;
use App\Models\Kopi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KopiController extends Controller
{

    public function index()
    {
        $data = Kopi::all();

        return response()->json([
            'message' => 'Menu Kopi berhasil ditampilkan Nihh',
            'data'    => KopiResource::collection($data),
        ]);
    }


 public function store(Request $request)
{
    if ($request->has('tersedia')) {
        $request->merge([
            'tersedia' => filter_var($request->tersedia, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    $validated = $request->validate([
        'nama'      => 'required|string|max:255',
        'jenis'     => 'required|string',
        'ukuran_ml' => 'required|integer',
        'rasa'      => 'required|string',
        'harga'     => 'required|numeric',
        'tersedia'  => 'boolean',
    ]);

    $kopi = Kopi::create($validated);

    return response()->json([
        'message' => 'Kopi berhasil ditambahkan',
        'data'    => new KopiResource($kopi),
    ], 201);
}

  
    public function show($id)
    {
        $kopi = Kopi::findOrFail($id);

        return response()->json([
            'message' => 'Kopi berhasil ditampilkan',
            'data'    => new KopiResource($kopi),
        ]);
    }


    public function update(Request $request, $id)
{
    $kopi = Kopi::findOrFail($id);

    if ($request->has('tersedia')) {
        $request->merge([
            'tersedia' => filter_var($request->tersedia, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    $validated = $request->validate([
        'nama'      => 'sometimes|required|string|max:255',
        'jenis'     => 'sometimes|required|string',
        'ukuran_ml' => 'sometimes|required|integer',
        'rasa'      => 'sometimes|required|string',
        'harga'     => 'sometimes|required|numeric',
        'tersedia'  => 'sometimes|boolean',
    ]);

    $kopi->update($validated);

    return response()->json([
        'message' => 'Kopi berhasil diubah',
        'data'    => new KopiResource($kopi),
    ]);
}


    public function destroy($id)
    {
        $kopi = Kopi::findOrFail($id);

        if ($kopi->gambar) {
            Storage::disk('public')->delete($kopi->gambar);
        }

        $kopi->delete();

        return response()->json([
            'message' => 'Kopi berhasil dihapus',
        ]);
    }

    function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }
}

//jangan lupa follow ig saya buat yang liat ini yaa @rafly_dhana