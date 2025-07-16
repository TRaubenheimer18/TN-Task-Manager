<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = auth()->user();

    if ($user->role === 'admin') {
        $tasks = Task::latest()->get();
    } elseif ($user->role === 'member') {
        $tasks = Task::where('user_id', $user->id)
                     ->orWhere('assigned_to', $user->id)
                     ->latest()->get();
    } else { // guest
        $tasks = Task::where('assigned_to', $user->id)->latest()->get();
    }

    // Get all users to assign tasks to
    $users = User::all();

    return view('tasks.index', compact('tasks', 'users'));
}


    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $users = User::where('role', '!=', 'guest')->get();
        return view('tasks.create', compact('users'));
    }
 

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'deadline' => 'required|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        if (auth()->user()->role !== 'admin') {
            $request->merge(['assigned_to' => null]);
        }

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }

    public function updateStatus(Request $request, Task $task)
{
    $request->validate([
        'status' => 'required|in:pending,in-progress,completed',
    ]);

    if (!auth()->user()->isAdmin() && auth()->id() !== $task->user_id && auth()->id() !== $task->assigned_to) {
        abort(403);
    }

    $task->update(['status' => $request->status]);

    return response()->json(['success' => true]);
}


    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $task->user_id && auth()->id() !== $task->assigned_to) {
            abort(403);
        }

        return view('tasks.show', compact('task'));
    }

    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $task->user_id) {
            abort(403);
        }

        $users = User::where('role', '!=', 'guest')->get();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $task->user_id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'deadline' => 'required|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        if (auth()->user()->role !== 'admin') {
            $request->merge(['assigned_to' => null]);
        }

        $task->update($request->only('title', 'description', 'category', 'priority', 'deadline', 'assigned_to'));

        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $task->user_id) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }
}
