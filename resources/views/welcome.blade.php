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
      background-color: #eac1c1;
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 420px;
      padding: 32px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .btn {
      display: inline-block;
      width: 100%;
      padding: 12px 0;
      font-weight: 600;
      font-size: 1rem;
      border-radius: 8px;
      text-align: center;
      transition: background-color 0.2s;
    }

    .btn-primary {
      background-color: #1f2937;
      color: white;
    }

    .btn-primary:hover {
      background-color: #111827;
    }

    .btn-secondary {
      background-color: #d48a8a;
      color: white;
    }

    .btn-secondary:hover {
      background-color: #c97a7a;
    }
  </style>
</head>
<body>

  <div class="card">

    <h1 class="text-2xl font-bold mb-4 text-gray-800">Welcome</h1>

    <p class="text-gray-600 mb-6">
      Get things done one task at a time!
    </p>

    @guest
      <a href="{{ route('register') }}"
         class="btn btn-secondary mb-4">
        Register
      </a>

      <div class="flex justify-center items-center gap-2 text-sm mb-2">
        <span class="text-gray-500">Already registered?</span>
        <a href="{{ route('login') }}" class="text-[#6b7280] hover:underline font-medium">
          Log In
        </a>
      </div>
    @else
      <a href="{{ url('/dashboard') }}"
         class="btn btn-secondary">
        Open Dashboard
      </a>
    @endguest

  </div>

</body>
</html>


