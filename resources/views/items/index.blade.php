<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body class="container py-5">
    <div class="container">
        @if(session('api_token'))
        <a href="{{ route('logout') }}" class="btn btn-danger float-end">Logout</a>
        @endif
    </div>
    <h1>Item List</h1>
    <a href="{{ route('items.create') }}" class="btn btn-primary my-3">Add New Item</a>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table id="itemsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#itemsTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [5, 10, 25, 50, 100],
                "ordering": true,
                "searching": true,
                "info": true,
                "autoWidth": false,
                "language": {
                    "search": "Search items:",
                    "lengthMenu": "Show _MENU_ entries per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries"
                }
            });
        });
    </script>
</body>

</html>