<!DOCTYPE html>
<html>
<head>
    <title>Edytuj zwierzę</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2>Edytuj zwierzę</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('pets.update', $pet['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Nazwa:</label>
                        <input type="text" class="form-control" name="name" value="{{ $pet['name'] }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Kategoria:</label>
                        <input type="text" class="form-control" name="category" value="{{ $pet['category']['name'] ?? '' }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select class="form-select" name="status" required>
                            <option value="available" {{ $pet['status'] == 'available' ? 'selected' : '' }}>Dostępny</option>
                            <option value="pending" {{ $pet['status'] == 'pending' ? 'selected' : '' }}>Oczekujący</option>
                            <option value="sold" {{ $pet['status'] == 'sold' ? 'selected' : '' }}>Sprzedany</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">URL zdjęcia:</label>
                        <input type="url" class="form-control" name="photo_url" value="{{ $pet['photoUrls'][0] ?? '' }}" required>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                        <a href="{{ route('pets.index') }}" class="btn btn-secondary">Powrót</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 