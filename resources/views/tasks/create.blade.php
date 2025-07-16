<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">➕ Create Task</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <x-input-label for="title" value="Title" />
            <x-text-input name="title" class="w-full mb-3" required />

            <x-input-label for="description" value="Description" />
            <textarea name="description" class="form-control mb-3" required></textarea>

            <x-input-label for="category" value="Category" />
            <select name="category" class="form-select mb-3" required>
                <option value="development">Development</option>
                <option value="design">Design</option>
                <option value="testing">Testing</option>
                <option value="deployment">Deployment</option>
            </select>

            <x-input-label for="priority" value="Priority" />
            <select name="priority" class="form-select mb-3" required>
                <option value="high">High</option>
                <option value="medium" selected>Medium</option>
                <option value="low">Low</option>
            </select>

            <x-input-label for="deadline" value="Deadline" />
            <x-text-input type="date" name="deadline" class="w-full mb-3" required />

            <x-input-label for="assigned_to" value="Assign To" />
            <select name="assigned_to" class="form-select mb-4">
                <option value="">Unassigned</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <x-primary-button>Create Task</x-primary-button>
        </form>
    </div>
</x-app-layout>
