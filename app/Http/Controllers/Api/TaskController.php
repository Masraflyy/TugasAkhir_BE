<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{

    public function index()
    {
        $data = Task::all();

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


        $task = Task::create($validated);

        return response()->json([
            'message' => 'Kopi berhasil ditambahkan',
            'data'    => new TaskResource($task),
        ], 201);
    }

  
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json([
            'message' => 'Kopi berhasil ditampilkan',
            'data'    => new TaskResource($task),
        ]);
    }


    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

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
            if ($task->gambar) {
                Storage::disk('public')->delete($task->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('kopi', 'public');
        }

        $task->update($validated);

        return response()->json([
            'message' => 'Kopi berhasil diubah',
            'data'    => new TaskResource($task),
        ]);
    }


    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->gambar) {
            Storage::disk('public')->delete($task->gambar);
        }

        $task->delete();

        return response()->json([
            'message' => 'Kopi berhasil dihapus',
        ]);
    }
}