<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return response()->json([
            'message' => 'Daftar task berhasil diambil',
            'data' => TaskResource::collection($tasks),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'message' => 'Detail task berhasil diambil',
            'data' => new TaskResource($task),
            ]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $task->update($validated);

        return response()->json([
            'message' => 'Task berhasil diperbarui',
            'data' => new TaskResource($task),
        ]);            
    }

    public function destroy($id){
        $task = Task::find($id);
        
        if (!$task){
        return response()->json([
            'message' => 'Task tidak di temukan'
        ], 404);
        }

        $task->delete();

        return response()->json([
            'message'=> 'Task berhasil di hapus',
        ]);
    }
}