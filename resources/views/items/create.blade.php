<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
   
   
</head>
<body class="container py-5">
<div class="container">
        @if(session('api_token'))
            <a href="{{ route('logout') }}" class="btn btn-danger float-end">Logout</a>
        @endif
    </div>
    <h1>Create Item</h1>
    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>
