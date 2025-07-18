<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-pink-700 flex items-center gap-2">
            👩‍💼 <span>Admin Dashboard</span>
        </h2>
    </x-slot>

    
    <div class="min-h-screen p-6" style="background-color: #F4C2C2;">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
            <p class="text-gray-800 text-lg mb-6">
                Welcome, <span class="font-semibold">{{ auth()->user()->name }}</span>!
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('tasks.create') }}"
                   class="inline-flex items-center justify-center bg-purple-600 hover:bg-purple-700 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-200 shadow-sm">
                    ➕ Create Task
                </a>

                <a href="{{ route('tasks.index') }}"
                   class="inline-flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-200 shadow-sm">
                    📋 View All Tasks
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
