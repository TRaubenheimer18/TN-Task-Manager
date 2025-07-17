<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-pink-800">📋 My Tasks</h2>
    </x-slot>

    {{-- Page Background --}}
    <div class="min-h-screen py-10 px-6 md:px-12" style="background-color: #F4C2C2;">
        {{-- Top Bar: Filter only --}}
        <div class="mb-8 max-w-md">
            {{-- Filter Dropdown --}}
            <form method="GET" class="w-full">
                <label for="status" class="block text-base font-semibold text-gray-800 mb-3">
    Filter by Status:
</label>

                <select name="status" id="status" onchange="this.form.submit()"
                    class="w-full rounded-md border border-gray-300 shadow-sm bg-white text-sm px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in-progress" {{ request('status') === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </form>
        </div>

        {{-- Task List --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse ($tasks as $task)
                @include('tasks.partials.card', ['task' => $task])
            @empty
                <div class="col-span-full text-center text-gray-700">
                    <p class="text-lg">No tasks available.</p>
                </div>
            @endforelse
        </div>

        {{-- Create Task Button below cards --}}
        <div class="flex justify-center">
            <a href="{{ route('tasks.create') }}"
                class="inline-flex items-center justify-center bg-teal-600 hover:bg-teal-700 text-white text-lg font-semibold rounded-xl px-8 py-4 shadow-lg transition duration-300">
                ➕ Create New Task
            </a>
        </div>
    </div>

    {{-- JavaScript for Status Update --}}
    @push('scripts')
    <script>
        document.querySelectorAll('.save-status-btn').forEach(button => {
            button.addEventListener('click', function () {
                const taskId = this.dataset.taskId;
                const select = document.querySelector(`.status-select[data-task-id="${taskId}"]`);
                const newStatus = select.value;

                fetch(`/tasks/${taskId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated!');
                    } else {
                        alert('Failed to update.');
                    }
                })
                .catch(() => alert('Server error.'));
            });
        });
    </script>
    @endpush
</x-app-layout>
