<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1>Welcome to the Dashboard!</h1>
    @if(session('api_token'))
    <p>Welcome! You are logged in.</p>
    <a href="{{ route('items.create') }}">Add Items</a> ||
    <a href="{{ route('logout') }}">Logout</a>

    <!-- <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form> -->
    @else
    <a href="{{ route('registerform') }}">Register</a>/<a href="{{ route('login') }}">Login</a>

    @endif
</body>

</html>