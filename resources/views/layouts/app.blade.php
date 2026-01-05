<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel App')</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background: #222;
            padding: 10px;
        }
        header a {
            color: white;
            margin-right: 10px;
            text-decoration: none;
        }
        main {
            padding: 20px;
        }
    </style>
</head>
<body>

<header>
    <a href="/">Home</a>

    @auth
        <a href="/dashboard">Dashboard</a>
        <a href="/admin/categories">Admin</a>

        <form action="{{ route('logout') }}" method="POST" style="display:inline">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    @endauth
</header>

<main>
    @yield('content')
</main>

</body>
</html>
