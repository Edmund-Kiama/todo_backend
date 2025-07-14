<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskAssigned;

class TaskController extends Controller
{
    // Get all tasks (admin)
    public function index()
    {
        return Task::with('user')->get();
    }

    // Assign new task (admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'user' => 'required|email|exists:users,email',
            'deadline' => 'required|date',
            'status' => 'nullable|in:Pending,Completed'
        ]);

        // Get the user model
        $user = User::where('email', $validated['user'])->first();

        // Create the task
        $task = Task::create([
            'title' => $validated['title'],
            'user_id' => $user->id,
            'deadline' => $validated['deadline'],
            'status' => $validated['status'] ?? 'Pending'
        ]);

        // Send email
        // $task->load('user'); 
        // Mail::to($user->email)->send(new TaskAssigned($task));

        return response()->json(['task' => $task], 201);
    }

    //delete tasks 
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Task deleted']);
    }

    // Update task status or deadline
    public function update(Request $request, Task $task)
    {
        $task->update($request->only(['title', 'status', 'deadline']));
        return response()->json($task);
    }

    // Get tasks for a specific user
    public function userTasks($userId)
    {
        return Task::where('user_id', $userId)->get();
    }
}
