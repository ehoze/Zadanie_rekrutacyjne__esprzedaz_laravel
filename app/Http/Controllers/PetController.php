<?php

namespace App\Http\Controllers;

use App\Services\PetStoreService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Kontroler odpowiedzialny za zarządzanie zwierzętami
 * Obsługuje wszystkie operacje CRUD poprzez PetStoreService
 */
class PetController extends Controller
{
    private $petStoreService;

    /**
     * Wstrzykujemy zależność PetStoreService przez konstruktor
     */
    public function __construct(PetStoreService $petStoreService)
    {
        $this->petStoreService = $petStoreService;
    }

    /**
     * Wyświetla listę wszystkich zwierząt
     * GET /pets
     */
    public function index()
    {
        try {
            // Log::info('Próba pobrania listy zwierząt');
            $pets = $this->petStoreService->getAllPets();
            // Log::info('Struktura otrzymanych danych:', ['pets' => $pets]);
            // Log::info('Pobrano listę zwierząt', ['count' => count($pets)]);
            return view('pets.index', compact('pets'));
        } catch (Exception $e) {
            Log::error('Błąd podczas pobierania listy zwierząt', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect('/')
                ->with('error', 'Wystąpił błąd podczas pobierania danych: ' . $e->getMessage());
        }
    }

    /**
     * Wyświetla formularz dodawania nowego zwierzęcia
     * GET /pets/create
     */
    public function create()
    {
        return view('pets.create');
    }

    /**
     * Zapisuje nowe zwierzę w API
     * POST /pets
     */
    public function store(Request $request)
    {
        try {
            // Przygotowujemy dane w formacie wymaganym przez API
            $data = [
                'id' => time() . rand(100, 999), // Generujemy losowe ID aby uniknąć konfliktu z istniejącymi ID
                'name' => $request->name,
                'status' => $request->status,
                'category' => [
                    'id' => 1, // Używamy stałego ID kategorii dla uproszczenia
                    'name' => $request->category
                ],
                'photoUrls' => [$request->photo_url]
            ];

            $this->petStoreService->createPet($data);
            // Log::info('Zwierzę zostało dodane', ['data' => $data]);
            return redirect()->route('pets.index')->with('success', 'Zwierzę zostało dodane');
        } catch (Exception $e) {
            // Log::error('Błąd podczas tworzenia zwierzęcia', [
            //     'error' => $e->getMessage(),
            //     'trace' => $e->getTraceAsString()
            // ]);
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Wyświetla formularz edycji zwierzęcia
     * GET /pets/{id}/edit
     */
    public function edit($id)
    {
        try {
            $pet = $this->petStoreService->getPet($id);
            return view('pets.edit', compact('pet'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Aktualizuje dane zwierzęcia w API
     * PUT /pets/{id}
     */
    public function update(Request $request, $id)
    {
        try {
            // Przygotowujemy dane w formacie wymaganym przez API
            $data = [
                'id' => $id,
                'name' => $request->name,
                'status' => $request->status,
                'category' => [
                    'id' => 1, // Używamy stałego ID kategorii dla uproszczenia
                    'name' => $request->category
                ],
                'photoUrls' => [$request->photo_url]
            ];

            $this->petStoreService->updatePet($data);
            return redirect()->route('pets.index')->with('success', 'Dane zwierzęcia zostały zaktualizowane');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Usuwa zwierzę z API
     * DELETE /pets/{id}
     */
    public function destroy($id)
    {
        try {
            $this->petStoreService->deletePet($id);
            return redirect()->route('pets.index')->with('success', 'Zwierzę zostało usunięte');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
} 