<div class="task-card p-3 border rounded mb-3">
    <h3>{{ $task->title }}</h3>

    <p><strong>Description:</strong> {{ $task->description }}</p>

    <p><strong>Status:</strong></p>
    <select class="status-select form-select w-auto mb-2" data-task-id="{{ $task->id }}">
        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in-progress" {{ $task->status === 'in-progress' ? 'selected' : '' }}>In Progress</option>
        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
    </select>

    <button class="btn btn-primary save-status-btn mb-2" data-task-id="{{ $task->id }}">Save</button>

    <p><strong>Assigned To:</strong> {{ $task->assignedUser?->name ?? 'Unassigned' }}</p>

    @if(auth()->user()->role === 'admin' && $task->status === 'completed')
        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mt-2" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    @endif
    
</div>
