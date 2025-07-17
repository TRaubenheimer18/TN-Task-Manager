<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">➕ Create Task</h2>
    </x-slot>

    {{-- Custom light pink background --}}
    <div class="py-4 px-6 min-h-screen" style="background-color: #F4C2C2;">
        <form method="POST" action="{{ route('tasks.store') }}" class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
            @csrf

            <x-input-label for="title" value="Title" />
            <x-text-input name="title" class="w-full mb-3" required />

            <x-input-label for="description" value="Description" />
            <textarea name="description" class="form-control w-full rounded-md border-gray-300 mb-3" required></textarea>

            <x-input-label for="category" value="Category" />
            <select name="category" class="form-select w-full rounded-md border-gray-300 mb-3" required>
                <option value="development">Development</option>
                <option value="design">Design</option>
                <option value="testing">Testing</option>
                <option value="deployment">Deployment</option>
            </select>

            <x-input-label for="priority" value="Priority" />
            <select name="priority" class="form-select w-full rounded-md border-gray-300 mb-3" required>
                <option value="high">High</option>
                <option value="medium" selected>Medium</option>
                <option value="low">Low</option>
            </select>

            <x-input-label for="deadline" value="Deadline" />
            <x-text-input type="date" name="deadline" class="w-full mb-3" required />

            <x-input-label for="assigned_to" value="Assign To" />
            <select name="assigned_to" class="form-select w-full rounded-md border-gray-300 mb-4">
                <option value="">Unassigned</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <x-primary-button class="bg-purple-600 hover:bg-purple-700">Create Task</x-primary-button>
        </form>
    </div>
</x-app-layout>
