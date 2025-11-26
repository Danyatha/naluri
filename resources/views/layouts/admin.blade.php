<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md h-screen p-5">
            <h1 class="text-xl font-bold mb-6">Admin Panel</h1>

            <nav class="space-y-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="block p-2 rounded hover:bg-gray-200">Dashboard</a>

                <a href="{{ route('admin.products.index') }}"
                    class="block p-2 rounded hover:bg-gray-200">Products</a>

                <a href="{{ route('admin.activity.logs.index') }}"
                    class="block p-2 rounded hover:bg-gray-200">Activity Logs</a>
            </nav>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-10">
            <h2 class="text-2xl font-semibold mb-6">@yield('page-title')</h2>
            @yield('content')
        </main>

    </div>

</body>

</html>