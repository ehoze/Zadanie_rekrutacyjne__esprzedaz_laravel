<!DOCTYPE html>
<html>
<head>
    <title>Lista zwierząt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Lista zwierząt</h2>
                <a href="{{ route('pets.create') }}" class="btn btn-primary">Dodaj nowe zwierzę</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nazwa</th>
                                <th>Kategoria</th>
                                <th>Status</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pets as $pet)
                                <tr>
                                    <td>{{ $pet['id'] ?? 'Brak ID' }}</td>
                                    <td>{{ $pet['name'] ?? 'Brak nazwy' }}</td>
                                    <td>{{ $pet['category']['name'] ?? 'Brak kategorii' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $pet['status'] === 'available' ? 'success' : ($pet['status'] === 'pending' ? 'warning' : 'secondary') }}">
                                            {{ $pet['status'] ?? 'Brak statusu' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pets.edit', $pet['id'] ?? 0) }}" class="btn btn-sm btn-warning">Edytuj</a>
                                            <form action="{{ route('pets.destroy', $pet['id'] ?? 0) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 