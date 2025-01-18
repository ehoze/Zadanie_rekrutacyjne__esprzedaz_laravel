<!DOCTYPE html>
<html>
<head>
    <title>Pet Store API</title>
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
                <h2 class="mb-0">Pet Store API</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                        <h3 class="mb-4">Witaj w aplikacji Pet Store!</h3>
                        <p class="lead mb-4">
                            Ta aplikacja umożliwia zarządzanie zwierzętami poprzez API <code>petstore.swagger.io</code>.
                            Możesz dodawać, edytować, usuwać i przeglądać listę zwierząt.
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('pets.index') }}" class="btn btn-primary btn-lg">
                                Przejdź do zarządzania zwierzętami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0">Dostępne funkcje</h3>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Lista zwierząt</h5>
                                <p class="card-text">Przeglądaj wszystkie dostępne zwierzęta w systemie.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Dodawanie</h5>
                                <p class="card-text">Dodawaj nowe zwierzęta do systemu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Zarządzanie</h5>
                                <p class="card-text">Edytuj i usuwaj istniejące zwierzęta.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
