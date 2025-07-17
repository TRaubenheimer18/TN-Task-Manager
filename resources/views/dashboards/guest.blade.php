<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-pink-700">🎟️ Guest Dashboard</h2>
    </x-slot>

    <div class="p-6">
        <p class="mb-4">Welcome, Guest {{ auth()->user()->name }}!</p>
        <p>You have limited access. Upgrade your role to access more features.</p>
    </div>
</x-app-layout>
