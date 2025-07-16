<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-pink-700">👩‍💼 Admin Dashboard</h2>
    </x-slot>

    <div class="p-6">
        <p class="mb-4">Welcome, Admin {{ auth()->user()->name }}!</p>
        <a href="{{ route('tasks.create') }}" class="btn btn-pink">+ Create Task</a>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary ms-3">📋 View All Tasks</a>
    </div>
</x-app-layout>
