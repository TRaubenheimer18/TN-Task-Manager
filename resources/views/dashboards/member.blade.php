<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-pink-700">👩‍💻 Team Member Dashboard</h2>
    </x-slot>

    <div class="p-6">
        <p class="mb-4">Welcome, {{ auth()->user()->name }}!</p>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">📋 View My Tasks</a>
    </div>
</x-app-layout>
