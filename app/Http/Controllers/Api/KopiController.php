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
            'message' => 'Kopi berhasil ditampilkan',
            'data'    => TaskResource::collection($data),
        ]);
    }


    public function store(Request $request)
    {
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

        $validated = $request->validate([
            'nama'      => 'sometimes|required|string|max:255',
            'jenis'     => 'sometimes|required|string',
            'ukuran_ml' => 'sometimes|required|integer',
            'rasa'      => 'sometimes|required|string',
            'harga'     => 'sometimes|required|numeric',
            'tersedia'  => 'sometimes|boolean',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kopi->gambar) {
                Storage::disk('public')->delete($kopi->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('kopi', 'public');
        }

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
}