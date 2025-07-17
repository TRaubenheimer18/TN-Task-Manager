<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Welcome | Task Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
      background-color: #F4C2C2;
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .square-container {
      width: 400px;
      height: 400px;
      background: white;
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 20px;
    }
  </style>
</head>
<body>

  <!-- Square Container -->
  <div class="square-container">

    <!-- Content Group -->
    <div style="width: 100%; max-width: 300px;">

      <h1 class="text-3xl font-bold mb-4 text-gray-800">Welcome</h1>

      <p class="text-gray-600 mb-8">
        Manage your tasks with ease
      </p>

      <!-- Register Button -->
      <div class="mb-4 w-full">
        @guest
        <span class="text-sm text-gray-500">Click here to</span>
          <a href="{{ route('register') }}"
             class="block w-full bg-[#d48a8a] hover:bg-[#c97a7a] text-white py-3 rounded-lg text-lg font-medium transition">
            Register
          </a>
        @endguest
      </div>

      <!-- Login Section -->
      <div class="flex items-center justify-center gap-2 mb-6">
        @guest
          <span class="text-sm text-gray-500">Existing User?</span>
          <a href="{{ route('login') }}"
             class="text-[#d48a8a] hover:underline text-sm font-medium">
            Log In
          </a>
        @else
          <a href="{{ url('/dashboard') }}"
             class="block w-full bg-[#d48a8a] hover:bg-[#c97a7a] text-white py-3 rounded-lg text-lg font-medium transition">
            Open Dashboard
          </a>
        @endguest
      </div>

    </div>
  </div>

</body>
</html>
