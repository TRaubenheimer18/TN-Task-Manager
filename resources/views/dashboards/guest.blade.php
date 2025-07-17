<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-pink-700">🎟️ Guest Dashboard</h2>
    </x-slot>

    <div class="bg-[#F4C2C2] min-h-screen py-8 px-4">
        <div class="max-w-4xl mx-auto">

            {{-- Welcome Section --}}
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <p class="text-lg mb-4">Welcome, Guest <strong>{{ auth()->user()->name }}</strong>!</p>
                <p class="text-gray-700">You can create and view temporary tasks below. These tasks are <strong>not saved</strong> to the database and will disappear if you refresh the page. To access full features, upgrade your role.</p>
            </div>

            {{-- Temporary Task Form --}}
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <h3 class="text-pink-700 text-lg font-semibold mb-4">📝 Create a Temporary Task</h3>
                <form id="guest-task-form">
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" id="title" name="title" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="3" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400" required></textarea>
                    </div>
                    <button type="submit"
                        class="bg-teal-600 hover:bg-teal-700 text-gray-600 font-semibold rounded-xl px-6 py-3 shadow-md transition duration-300">
                        ➕ Add Task
                    </button>
                </form>
            </div>

            {{-- Temporary Tasks List --}}
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h3 class="text-pink-700 text-lg font-semibold mb-4">📋 Your Temporary Tasks</h3>
                <p class="text-sm text-gray-600 mb-4">These tasks will disappear once the page is refreshed.</p>
                <div id="tasks-container" class="space-y-4"></div>
            </div>
        </div>
    </div>

    {{-- JavaScript to simulate temporary tasks --}}
    <script>
        const form = document.getElementById('guest-task-form');
        const container = document.getElementById('tasks-container');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const title = document.getElementById('title').value;
            const description = document.getElementById('description').value;

            const card = document.createElement('div');
            card.className = 'bg-[#FDFDFD] border border-gray-300 rounded-xl shadow p-4';
            card.innerHTML = `
                <h4 class="font-bold text-lg text-gray-800 mb-1">📌 ${title}</h4>
                <p class="text-gray-700"><strong>Description:</strong> ${description}</p>
            `;

            container.appendChild(card);
            form.reset();
        });
    </script>
</x-app-layout>
