<!DOCTYPE html>
<html>
<head>
    <title>Dodaj zwierzę</title>
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
                <h2>Dodaj nowe zwierzę</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('pets.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nazwa:</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Kategoria:</label>
                        <input type="text" class="form-control" name="category" value="{{ old('category') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select class="form-select" name="status" required>
                            <option value="available">Dostępny</option>
                            <option value="pending">Oczekujący</option>
                            <option value="sold">Sprzedany</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">URL zdjęcia:</label>
                        <input type="url" class="form-control" name="photo_url" value="{{ old('photo_url') }}" required>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Dodaj</button>
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