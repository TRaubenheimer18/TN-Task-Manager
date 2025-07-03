<x-app-layout>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">My Tasks</h2>
            <a href="{{ route('tasks.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition duration-150 ease-in-out flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add Task
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($tasks->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No tasks yet</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating your first task.</p>
                <div class="mt-6">
                    <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Task
                    </a>
                </div>
            </div>
        @else
            <ul class="space-y-3">
                @foreach ($tasks as $task)
                    <li class="bg-white overflow-hidden shadow rounded-lg transition-all duration-150 hover:shadow-md">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $task->title }}</h3>
                                        @if($task->due_date && now()->gt(\Carbon\Carbon::parse($task->due_date)))
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Overdue
                                            </span>
                                        @endif
                                    </div>

                                    @if($task->description)
                                        <p class="mt-1 text-sm text-gray-500">{{ $task->description }}</p>
                                    @endif
                                    
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Priority: {{ ucfirst($task->priority) }}
                                        </span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            Status: {{ ucfirst($task->status) }}
                                        </span>
                                        @if($task->due_date)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 sm:ml-4 flex space-x-3">
                                    <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            
            @if($tasks->hasPages())
                <div class="mt-6">
                    {{ $tasks->links() }}
                </div>
            @endif
        @endif
    </div>
</x-app-layout>