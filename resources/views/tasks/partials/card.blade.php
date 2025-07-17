<div class="w-full md:w-48 rounded-md border border-gray-300 shadow-sm bg-white px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none">
    <p class="mb-2">
        <span class="font-semibold text-gray-900">Title:</span>
        <span class="text-lg font-bold text-rose-600">{{ $task->title }}</span>
    </p>

    <p class="text-gray-700 mb-4">
        <span class="font-semibold text-gray-900">Description:</span>
        {{ $task->description }}
    </p>

    <div class="mb-4">
        <label class="block font-semibold text-gray-900 mb-1">Status:</label>
        <select
            class="status-select w-full md:w-1/3 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400"
            data-task-id="{{ $task->id }}"
        >
            <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in-progress" {{ $task->status === 'in-progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

    <button
        class="save-status-btn inline-block bg-rose-600 hover:bg-rose-700 text-gray-900 font-medium py-2 px-4 rounded-lg shadow transition duration-300 mb-4"
        data-task-id="{{ $task->id }}"
    >
        💾 Save
    </button>

    <p class="text-gray-700 mb-4">
        <span class="font-semibold text-gray-900">Assigned To:</span>
        {{ $task->assignedUser?->name ?? 'Unassigned' }}
    </p>

    @if(auth()->user()->role === 'admin' && $task->status === 'completed')
        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="block">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 hover:bg-red-600 text-gray-900 font-medium py-2 px-4 rounded-lg shadow transition duration-300 w-full max-w-xs">
                🗑️ Delete
            </button>
        </form>
    @endif
</div>
