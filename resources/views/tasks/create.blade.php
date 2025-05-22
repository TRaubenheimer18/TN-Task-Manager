<x-app-layout>
    <div class="max-w-2xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Create New Task</h2>
        
        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label for="title" class="block font-medium">Title*</label>
                <input type="text" name="title" id="title" required class="w-full rounded border-gray-300">
            </div>
            
            <div>
                <label for="description" class="block font-medium">Description</label>
                <textarea name="description" id="description" class="w-full rounded border-gray-300"></textarea>
            </div>
            
            <div>
                <label for="priority" class="block font-medium">Priority</label>
                <select name="priority" id="priority" class="w-full rounded border-gray-300">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            
            <div>
                <label for="due_date" class="block font-medium">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="w-full rounded border-gray-300">
            </div>
            
            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded">Create Task</button>
        </form>
    </div>
</x-app-layout>
