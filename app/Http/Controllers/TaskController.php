<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    //
    public function list(Request $request)
    {
        $tasks = Task::all();
        return response()->json([
            "message" => "Task retrived successfully!",
            "data" => $tasks
        ]);
    }

    // Test
    public function test(Request $request)
    {
        $name = $request->name;
        return response()->json([
            "name" => $name,
            "Test endpoint is working"
        ]);
    }

    // store
    public function store(Request $request)
    {
        // Image Postman theke form data theke data sent korte hobe
        try {
            $title = $request->title;
            $description = $request->description;

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('tasks/test', 'public');
            }

            $task = new Task();
            $task->title = $title;
            $task->description = $description;
            $task->image = $imagePath;
            $task->save();

            return response()->json([
                'message' => "Task Created Successfull!",
                'data' => $task,
            ], 201);
        } catch (Exception $th) {
            return response()->json([
                'message' => "Task Created Failed!",
                'error' => $th->getMessage(),
            ], 404);
        }
    }

    // Single Task
    public function single($id)
    {
        try {
            $task = Task::findOrFail($id);

            return response()->json([
                'message' => "Task retrived successfully!",
                'data' => $task
            ], 201);
        } catch (Exception $th) {
            return response()->json([
                'message' => "Task retrived Failed!",
                'error' => $th->getMessage(),
            ], 500);
        }
    }


    // Update / Edit Task
    public function update(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);


            $task->title = $request->title ?? $task->title;
            $task->description = $request->description ?? $task->description;

            if ($request->hasFile('image')) {

                if ($task->image && Storage::disk('public')->exists($task->image)) {
                    Storage::disk('public')->delete($task->image);
                }

                $imagePath = $request->file('image')->store('tasks/test', 'public');
                $task->image = $imagePath;
            }

            $task->save();
            return response()->json([
                'message' => 'Task Updated Successfully!',
                'data' => $task
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Task Update Failed!',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // Delete
    public function destory($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json([
            'message' => "Task Delete Success!",
        ]);
    }
}
