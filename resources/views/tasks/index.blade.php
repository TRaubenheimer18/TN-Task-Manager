<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">📋 My Tasks</h2>
    </x-slot>

    <div class="py-4 px-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <form method="GET" class="d-flex align-items-center">
                <select name="status" onchange="this.form.submit()" class="form-select w-auto">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in-progress" {{ request('status') === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </form>
            <a href="{{ route('tasks.create') }}" class="btn btn-pink">+ Create Task</a>
        </div>

        <div class="row">
            @forelse ($tasks as $task)
                @include('tasks.partials.card', ['task' => $task])
            @empty
                <p>No tasks available.</p>
            @endforelse
        </div>
    </div>

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
